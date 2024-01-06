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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('coffeeshop_id');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('slug');
            $table->timestamps();

            $table->foreign('coffeeshop_id')->references('id')->on('coffee_shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
