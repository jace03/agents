<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('genre', 100)->nullable();
            $table->unsignedSmallInteger('release_year')->nullable();
            $table->string('director')->nullable();
            $table->decimal('rating', 3, 1)->nullable();
            $table->unsignedSmallInteger('duration_minutes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
