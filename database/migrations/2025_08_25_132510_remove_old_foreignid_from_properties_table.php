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
        Schema::table('properties', function (Blueprint $table) {
            // First drop the foreign key constraint
            $table->dropForeign(['property_type_id']);  

            // Then drop the column
            $table->dropColumn('property_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Re-add column (if rollback)
            $table->foreignId('property_type_id')
                  ->constrained()   // assumes default table naming
                  ->cascadeOnDelete();
        });
    }
};
