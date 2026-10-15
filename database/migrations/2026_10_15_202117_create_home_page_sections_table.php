<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_page_sections', function (Blueprint $table) {
            $table->id();

            $table->string('key')->unique();
            $table->string('name');

            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();

            $table->json('paragraphs')->nullable();

            $table->text('quote')->nullable();
            $table->string('quote_author')->nullable();

            $table->string('image')->nullable();
            $table->json('gallery')->nullable();

            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_page_sections');
    }
};
