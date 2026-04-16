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
        Schema::table('career_entries', function (Blueprint $table) {
            $table->string('location')->nullable()->after('type');
            $table->json('skills')->nullable()->after('description');
            $table->string('project_title')->nullable()->after('skills');
            $table->string('project_url')->nullable()->after('project_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_entries', function (Blueprint $table) {
            $table->dropColumn(['location', 'skills', 'project_title', 'project_url']);
        });
    }
};
