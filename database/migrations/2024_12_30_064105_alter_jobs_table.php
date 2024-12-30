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
        Schema::table("jobs", function (Blueprint $table) {
            $table->unsignedBigInteger('bhk_id')->nullable()->after('user_id'); //
            
            // Define the foreign key constraint
            $table->foreign('bhk_id')
            ->references('id')
            ->on('jobs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
