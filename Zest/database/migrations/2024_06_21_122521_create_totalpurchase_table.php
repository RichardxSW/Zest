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
        Schema::create('totalpurchase', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('supplier_name');
            $table->integer('quantity');
            $table->date('in_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('totalpurchase');
    }
};
