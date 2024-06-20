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
        Schema::table('category', function (Blueprint $table) {
            //
            $table->integer('total_products')->default(0); // Tambahkan kolom ini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category', function (Blueprint $table) {
            //
            $table->dropColumn('total_products');
        });
    }
};
