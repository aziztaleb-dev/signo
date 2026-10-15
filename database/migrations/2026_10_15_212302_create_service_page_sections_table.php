<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_page_sections', function (Blueprint $table) {
            $table->id();

            // Identifiant technique de la section
            $table->string('key')->unique();

            // Nom affiché dans le dashboard
            $table->string('name');

            // Contenu textuel
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();

            // Paragraphes et listes modifiables
            $table->json('paragraphs')->nullable();
            $table->json('items')->nullable();

            // Citation
            $table->text('quote')->nullable();
            $table->string('quote_author')->nullable();

            // Image principale et galerie
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();

            // Bouton éventuel
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();

            // Ordre et activation
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_page_sections');
    }
};
