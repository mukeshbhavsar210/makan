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
            $table->enum('is_featured', ['Yes', 'No'])->default('No')->after('bathroom_id');
            $table->json('related_properties')->after('total_area');                    
            $table->json('rera')->after('size');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties',function(Blueprint $table){
            $table->dropColumn('is_featured');
            $table->dropColumn('related_properties');
            $table->dropColumn('rera');
        });
    }
};
