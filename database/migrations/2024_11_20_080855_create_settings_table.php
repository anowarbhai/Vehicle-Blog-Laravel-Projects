<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('site_name'); // Name of the site
            $table->string('logo')->nullable(); // Logo URL (nullable)
            $table->string('fav_icon')->nullable(); // Favicon URL (nullable)
            $table->string('phone')->nullable(); // Phone number (nullable)
            $table->string('email')->nullable(); // Email address (nullable)
            $table->text('address')->nullable(); // Address (nullable)
            $table->string('copyright')->nullable(); // Copyright text (nullable)
            $table->string('facebook')->nullable(); // Facebook URL (nullable)
            $table->string('instagram')->nullable(); // Instagram URL (nullable)
            $table->string('twitter')->nullable(); // Twitter URL (nullable)
            $table->string('youtube')->nullable(); // YouTube URL (nullable)
            $table->string('meta_title')->nullable(); // Meta title for SEO (nullable)
            $table->string('meta_desc')->nullable(); // Meta description for SEO (nullable)
            $table->string('meta_keyword')->nullable(); // Meta keywords for SEO (nullable)
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
