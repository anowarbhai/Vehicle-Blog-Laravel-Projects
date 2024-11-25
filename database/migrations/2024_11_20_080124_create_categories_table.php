<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('title'); // Title of the category
            $table->string('slug')->unique(); // Slug for URL
            $table->string('image')->nullable(); // Image URL (nullable)
            $table->text('description')->nullable(); // Description of the category (nullable)
            $table->string('meta_title')->nullable(); // Meta title for SEO (nullable)
            $table->string('meta_desc')->nullable(); // Meta description for SEO (nullable)
            $table->string('meta_keyword')->nullable(); // Meta keywords for SEO (nullable)
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}