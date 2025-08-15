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
            $table->foreignId('amenity_id')
                  ->nullable() // if not always set
                  ->constrained('amenities') // references id in constructions table
                  ->cascadeOnUpdate()
                  ->nullOnDelete(); // set null if related construction deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['amenity_id']);
            $table->dropColumn('amenity_id');
        });
    }
};
