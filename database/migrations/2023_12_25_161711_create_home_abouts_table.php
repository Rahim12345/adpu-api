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
        Schema::create('home_abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title_1')->nullable();
            $table->string('title_2')->nullable();
            $table->text('intro_text')->nullable();
            $table->string('src')->nullable();
            $table->string('alt')->nullable();
            $table->string('icon')->nullable();

            $table->integer('order_no')->default(0);
            $table->boolean('deleted')->default(0);
            $table->unsignedBigInteger('creator');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_abouts');
    }
};
