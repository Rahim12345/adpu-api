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
        Schema::create('route_lists', function (Blueprint $table) {
            $table->id();
            $table->string('in_natural_language_name_az');
            $table->string('in_natural_language_name_en');
            $table->string('route_name');

            $table->boolean('deleted')->default(0);
            $table->integer('order_no')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_lists');
    }
};
