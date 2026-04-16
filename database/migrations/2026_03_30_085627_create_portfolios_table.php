<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->json('tags')->nullable();          // ['Python', 'TensorFlow', ...]
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->enum('type', ['project', 'certification'])->default('project');
            $table->string('issuer')->nullable();        // for certifications
            $table->date('issued_date')->nullable();     // for certifications
            $table->string('cert_url')->nullable();      // certification PDF/link
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
