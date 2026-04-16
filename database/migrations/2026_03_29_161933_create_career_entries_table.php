<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_entries', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('position');
            $table->string('type')->default('full-time'); // internship, full-time, freelance
            $table->date('start_date');
            $table->date('end_date')->nullable(); // null = Present
            $table->json('description')->nullable(); // array of bullet strings
            $table->string('logo_url')->nullable();
            $table->json('media_urls')->nullable(); // array of image URLs, max 3
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_entries');
    }
};
