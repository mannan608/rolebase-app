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
        Schema::create('events', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->string('slug')
                ->unique();

            $table->text('short_description')
                ->nullable();

            $table->longText('description');

            $table->string('banner')
                ->nullable();

            $table->json('schedules')
                ->nullable();

            $table->string('organizer')
                ->nullable();

            $table->string('registration_link')
                ->nullable();

            $table->string('contact_email')
                ->nullable();

            $table->string('contact_phone')
                ->nullable();

            $table->json('providers')
                ->nullable();

            $table->json('gallery_images')
                ->nullable();

            $table->json('tags')
                ->nullable();

            $table->json('benefits')
                ->nullable();

            $table->json('services_offered')
                ->nullable();

            $table->json('faqs')
                ->nullable();

            $table->text('google_map_link')
                ->nullable();

            $table->enum('status', [
                'upcoming',
                'ongoing',
                'completed',
                'cancelled'
            ])->default('upcoming');

            $table->boolean('is_featured')
                ->default(false);

            $table->unsignedBigInteger('views')
                ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};