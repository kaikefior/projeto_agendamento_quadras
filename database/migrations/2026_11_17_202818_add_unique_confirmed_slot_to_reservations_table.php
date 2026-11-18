<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(
            "CREATE UNIQUE INDEX reservations_confirmed_slot_unique
            ON reservations (court_id, start_time)
            WHERE status = 'confirmed'"
        );
    }
    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS reservations_confirmed_slot_unique');
        
    }
};
