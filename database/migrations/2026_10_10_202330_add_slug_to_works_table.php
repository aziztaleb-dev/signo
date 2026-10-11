<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ajoute la colonne si elle n'existe pas
        if (! Schema::hasColumn('works', 'slug')) {
            Schema::table('works', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        // 2. Remplit les slugs, uniques par sous-catégorie
        $used = [];

        $works = DB::table('works')->orderBy('id')->get(['id', 'title', 'work_subcategory_id']);

        foreach ($works as $work) {
            $base = Str::slug($work->title) ?: 'travail';
            $slug = $base;
            $i = 2;

            while (isset($used[$work->work_subcategory_id][$slug])) {
                $slug = $base . '-' . $i++;
            }

            $used[$work->work_subcategory_id][$slug] = true;

            DB::table('works')->where('id', $work->id)->update(['slug' => $slug]);
        }

        // 3. Colonne obligatoire + unicité par sous-catégorie
        DB::statement('ALTER TABLE works MODIFY slug VARCHAR(255) NOT NULL');

        Schema::table('works', function (Blueprint $table) {
            $table->unique(['work_subcategory_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropUnique(['work_subcategory_id', 'slug']);
            $table->dropColumn('slug');
        });
    }
};
