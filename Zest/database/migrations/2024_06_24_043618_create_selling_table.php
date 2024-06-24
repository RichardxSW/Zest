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
        Schema::create('selling', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('category_name');
            $table->string('customer_name');
            $table->integer('quantity');
            $table->date('date');
            $table->enum('status', ['pending', 'approved'])->default('pending'); // Add default value for status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling');
    }
};