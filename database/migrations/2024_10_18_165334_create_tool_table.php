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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('tool_name'); // Tool Name
            $table->string('tool_slug')->unique(); // Tool Slug
            $table->boolean('is_home')->default(false); // Is it Home?
            $table->string('meta_title')->nullable(); // Meta Title
            $table->string('meta_description',500)->nullable(); // Meta Description
            $table->string('language')->default('en'); // Language
            $table->string('is_parent')->nullable(); // isParent
            $table->json('content')->nullable(); // Content (in JSON format)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
