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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id');
            $table->string('title');
            $table->string('slug');
            $table->tinyInteger('category_id');
            $table->string('image');
            $table->longText('description');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->tinyInteger('is_publish')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_delete')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};