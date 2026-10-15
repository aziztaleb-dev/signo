<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Télécharge les images des works (liens https://signo.com.tn/...) vers le storage Laravel
 * avec un nom haché (comme ->store()), puis remplace les liens dans la colonne `images`.
 *
 * Fichier à placer dans : app/Console/Commands/ImportWorkImages.php
 *
 * Utilisation :
 *   php artisan works:import-images --dry-run --limit=3   (test sans rien télécharger)
 *   php artisan works:import-images --limit=3             (vrai test sur 3 works)
 *   php artisan works:import-images                       (tout)
 *
 * Relançable sans risque : seuls les liens encore distants (http...) sont traités.
 */
class ImportWorkImages extends Command
{
    protected $signature = 'works:import-images
                            {--disk=public : Disque Laravel (config/filesystems.php)}
                            {--dir=works : Dossier de destination dans le disque}
                            {--table=works : Table contenant la colonne images}
                            {--limit=0 : Nombre max de works à traiter (0 = tous)}
                            {--dry-run : Affiche ce qui serait fait sans rien télécharger}';

    protected $description = 'Télécharge les images distantes des works et les stocke dans le storage Laravel';

    /** url distante => chemin local déjà téléchargé (évite de télécharger 2 fois la même image) */
    private array $downloaded = [];

    private string $disk;
    private string $dir;
    private bool $dry;
    private int $okCount = 0;
    private int $failCount = 0;

    public function handle(): int
    {
        $this->disk = $this->option('disk');
        $this->dir = trim($this->option('dir'), '/');
        $this->dry = (bool) $this->option('dry-run');
        $table = $this->option('table');
        $limit = (int) $this->option('limit');
        $processed = 0;

        $query = DB::table($table)
            ->where('images', 'like', '%signo.com.tn%')
            ->orderBy('id');

        $this->info(sprintf(
            '%s works à traiter -> disque "%s", dossier "%s"%s',
            (clone $query)->count(),
            $this->disk,
            $this->dir,
            $this->dry ? ' (DRY RUN)' : ''
        ));

        $query->chunkById(50, function ($rows) use ($table, $limit, &$processed) {
            foreach ($rows as $row) {
                if ($limit > 0 && $processed >= $limit) {
                    return false; // stoppe le chunk
                }
                $processed++;

                $images = json_decode($row->images, true);
                if (!is_array($images)) {
                    $this->warn("#{$row->id} : colonne images illisible, ignoré");
                    continue;
                }

                $new = [];
                foreach ($images as $img) {
                    if (is_string($img) && preg_match('#^https?://#i', $img)) {
                        $new[] = $this->download($img) ?? $img; // en cas d'échec on garde le lien
                    } else {
                        $new[] = $img;
                    }
                }

                if (!$this->dry && $new !== $images) {
                    DB::table($table)->where('id', $row->id)->update([
                        'images' => json_encode($new, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                        'updated_at' => now(),
                    ]);
                }

                $this->line("#{$row->id} {$row->slug} : " . count($images) . ' image(s)');
            }
        });

        $this->newLine();
        $this->info("Terminé : {$this->okCount} images téléchargées, {$this->failCount} échecs.");
        if ($this->failCount > 0) {
            $this->warn('Relance la commande : les images en échec (liens encore http) seront retentées.');
        }

        return self::SUCCESS;
    }

    private function download(string $url): ?string
    {
        if (isset($this->downloaded[$url])) {
            return $this->downloaded[$url];
        }

        if ($this->dry) {
            $this->line("   [dry] $url");
            return null;
        }

        try {
            $res = Http::timeout(60)
                ->retry(3, 1000, throw: false)
                ->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; migration-script)'])
                ->get($url);
        } catch (\Throwable $e) {
            $this->failCount++;
            $this->warn("   échec : $url ({$e->getMessage()})");
            return null;
        }

        if (!$res->successful()) {
            $this->failCount++;
            $this->warn("   échec HTTP {$res->status()} : $url");
            return null;
        }

        $ext = strtolower(pathinfo((string) parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
            $ext = $this->extFromMime((string) $res->header('Content-Type'));
        }

        // Même format que ->store() : 40 caractères aléatoires + extension
        $path = $this->dir . '/' . Str::random(40) . '.' . $ext;
        Storage::disk($this->disk)->put($path, $res->body());

        $this->okCount++;
        return $this->downloaded[$url] = $path;
    }

    private function extFromMime(string $mime): string
    {
        return match (true) {
            str_contains($mime, 'png') => 'png',
            str_contains($mime, 'webp') => 'webp',
            str_contains($mime, 'gif') => 'gif',
            default => 'jpg',
        };
    }
}
