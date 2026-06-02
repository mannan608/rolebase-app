<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_metas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('event_id')->constrained()->onDelete('cascade');
        // route/page identifier
        $table->string('path')->unique(); // home, about, course:web-design

        // basic SEO
        $table->string('meta_title', 255)->nullable();
        $table->text('meta_description')->nullable();
        $table->text('meta_keywords')->nullable();

        // robots
        $table->string('robots')->nullable(); // index,follow / noindex,nofollow

        // canonical
        $table->string('canonical_url')->nullable();

        // open graph
        $table->string('og_title')->nullable();
        $table->text('og_description')->nullable();
        $table->string('og_image')->nullable();
        $table->string('og_type')->default('website');

        // twitter
        $table->string('twitter_title')->nullable();
        $table->text('twitter_description')->nullable();
        $table->string('twitter_image')->nullable();

        // schema markup
        $table->longText('schema_markup')->nullable();

        //dynamic scripts like google analytics, facebook pixel, etc.
        $table->json('header_scripts')->nullable(); 
        $table->json('footer_scripts')->nullable(); 

        // status
        $table->boolean('is_active')->default(true);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_metas');

    }
};
