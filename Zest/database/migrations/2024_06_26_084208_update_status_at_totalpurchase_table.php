<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the existing constraint
        DB::statement("ALTER TABLE totalpurchase DROP CONSTRAINT IF EXISTS totalpurchase_status_check");

        // Add the new constraint
        DB::statement("ALTER TABLE totalpurchase ADD CONSTRAINT totalpurchase_status_check CHECK (status IN ('pending', 'approved', 'declined'))");
    }

    public function down(): void
    {
        // Rollback the changes by restoring the original constraint
        DB::statement("ALTER TABLE totalpurchase DROP CONSTRAINT IF EXISTS totalpurchase_status_check");

        // Add the original constraint back
        DB::statement("ALTER TABLE totalpurchase ADD CONSTRAINT totalpurchase_status_check CHECK (status IN ('pending', 'approved'))");
    }
};
