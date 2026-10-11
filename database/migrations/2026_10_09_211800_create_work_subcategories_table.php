<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_category_id')
                ->constrained('work_categories')
                ->restrictOnDelete();
            $table->string('name');
            $table->timestamps();

            $table->unique(['work_category_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_subcategories');
    }
};
