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
        Schema::create('chronologies', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->text('content');
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
        Schema::dropIfExists('chronologies');
    }
};
