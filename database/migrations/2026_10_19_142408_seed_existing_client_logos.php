<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    public function up(): void
    {
        $logos = [
            'ADP',
            'Four Seasons',
            'Agence Italienne pour la Coopération au Développement',
            'Hilton',
            'Carrefour',
            'Peugeot',
            'Tunisair',
            'EY',
            'European Investment Bank',
            'Sheraton',
            'Azur City',
            'Anantara',
            'BIAT',
            'Radisson Blu',
            'Roche',
            'Rotary',
            'ONU',
            'Pharmaghreb',
        ];

        $now = now();

        foreach ($logos as $index => $name) {
            $filename = sprintf('client-%02d.png', $index + 1);
            $path = public_path('assets/images/' . $filename);

            if (!File::exists($path)) {
                continue;
            }

            DB::table('client_logos')->updateOrInsert(
                ['image' => 'assets/images/' . $filename],
                [
                    'name' => $name,
                    'position' => $index,
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }

    public function down(): void
    {
        DB::table('client_logos')
            ->where('image', 'like', 'assets/images/client-%')
            ->delete();
    }
};
