<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('title'); // Title of the post
            $table->string('slug')->unique(); // Slug for URL
            $table->string('image')->nullable(); // Image URL
            $table->text('description'); // Description of the post
            $table->unsignedBigInteger('category_id'); // Foreign key for the category
            $table->unsignedInteger('view')->default(0); // View count
            $table->string('meta_title')->nullable(); // Meta title for SEO
            $table->string('meta_desc')->nullable(); // Meta description for SEO
            $table->string('meta_keyword')->nullable(); // Meta keywords for SEO
            $table->timestamps(); // Created at and Updated at timestamps

            // Foreign key constraint for category_id
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
