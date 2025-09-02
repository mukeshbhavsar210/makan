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
        Schema::table('temp_images', function (Blueprint $table) {
            $table->foreignId('property_id')
                  ->nullable() // if not always set
                  ->constrained('temp_images') // references id in constructions table
                  ->cascadeOnUpdate()
                  ->nullOnDelete(); // set null if related construction deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temp_images', function (Blueprint $table) {
             $table->dropForeign(['property_id']);
            $table->dropColumn('property_id');
        });
    }
};
