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
        Schema::table('properties',function(Blueprint $table){
            $table->foreignId('bath_id')->nullable()->constrained()->onDelete('cascade')->after('bhk_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties',function(Blueprint $table){
            $table->dropColumn('bath_id');
        });
    }
};
