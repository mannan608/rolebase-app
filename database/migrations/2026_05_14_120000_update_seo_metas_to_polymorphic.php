<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('seo_metas_tmp', function (Blueprint $table) {
            $table->id();

            $table->nullableMorphs('seoable');

            $table->string('path')->unique();

            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->string('robots')->nullable();
            $table->string('canonical_url')->nullable();

            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->default('website');

            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();

            $table->longText('schema_markup')->nullable();

            $table->json('header_scripts')->nullable();
            $table->json('footer_scripts')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        if (Schema::hasTable('seo_metas')) {
            DB::table('seo_metas_tmp')->insertUsing(
                [
                    'id',
                    'seoable_id',
                    'seoable_type',
                    'path',
                    'meta_title',
                    'meta_description',
                    'meta_keywords',
                    'robots',
                    'canonical_url',
                    'og_title',
                    'og_description',
                    'og_image',
                    'og_type',
                    'twitter_title',
                    'twitter_description',
                    'twitter_image',
                    'schema_markup',
                    'header_scripts',
                    'footer_scripts',
                    'is_active',
                    'created_at',
                    'updated_at',
                ],
                DB::table('seo_metas')->select([
                    'id',
                    'event_id as seoable_id',
                    DB::raw("'" . addslashes(Event::class) . "' as seoable_type"),
                    'path',
                    'meta_title',
                    'meta_description',
                    'meta_keywords',
                    'robots',
                    'canonical_url',
                    'og_title',
                    'og_description',
                    'og_image',
                    'og_type',
                    'twitter_title',
                    'twitter_description',
                    'twitter_image',
                    'schema_markup',
                    'header_scripts',
                    'footer_scripts',
                    'is_active',
                    'created_at',
                    'updated_at',
                ])
            );

            Schema::drop('seo_metas');
        }

        Schema::rename('seo_metas_tmp', 'seo_metas');

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('seo_metas_tmp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('path')->unique();

            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->string('robots')->nullable();
            $table->string('canonical_url')->nullable();

            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->default('website');

            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();

            $table->longText('schema_markup')->nullable();

            $table->json('header_scripts')->nullable();
            $table->json('footer_scripts')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        if (Schema::hasTable('seo_metas')) {
            DB::table('seo_metas_tmp')->insertUsing(
                [
                    'id',
                    'event_id',
                    'path',
                    'meta_title',
                    'meta_description',
                    'meta_keywords',
                    'robots',
                    'canonical_url',
                    'og_title',
                    'og_description',
                    'og_image',
                    'og_type',
                    'twitter_title',
                    'twitter_description',
                    'twitter_image',
                    'schema_markup',
                    'header_scripts',
                    'footer_scripts',
                    'is_active',
                    'created_at',
                    'updated_at',
                ],
                DB::table('seo_metas')
                    ->where('seoable_type', Event::class)
                    ->whereNotNull('seoable_id')
                    ->select([
                        'id',
                        'seoable_id as event_id',
                        'path',
                        'meta_title',
                        'meta_description',
                        'meta_keywords',
                        'robots',
                        'canonical_url',
                        'og_title',
                        'og_description',
                        'og_image',
                        'og_type',
                        'twitter_title',
                        'twitter_description',
                        'twitter_image',
                        'schema_markup',
                        'header_scripts',
                        'footer_scripts',
                        'is_active',
                        'created_at',
                        'updated_at',
                    ])
            );

            Schema::drop('seo_metas');
        }

        Schema::rename('seo_metas_tmp', 'seo_metas');

        Schema::enableForeignKeyConstraints();
    }
};

