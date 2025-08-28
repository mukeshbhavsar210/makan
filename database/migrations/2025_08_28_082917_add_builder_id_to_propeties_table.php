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
            if (!Schema::hasColumn('properties', 'builder_id')) {
                $table->unsignedBigInteger('builder_id')->nullable()->after('user_id');
            }

            $table->foreign('builder_id')
                ->references('id')->on('builders')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['builder_id']);
            $table->dropColumn('builder_id');
        });
    }
};
