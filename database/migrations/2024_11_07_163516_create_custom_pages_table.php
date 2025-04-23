<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_name'); 
            $table->string('page_slug')->unique();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->json('content')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('custom_pages');
    }
};
