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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_type_id')->constrained()->onDelete('cascade');            
            $table->foreignId('amenity_id')->constrained()->onDelete('cascade');
            $table->string('location');
            $table->text('description')->nullable;
            $table->text('keywords')->nullable;
            $table->string('company_name');
            $table->string('company_location')->nullable;
            $table->string('company_website')->nullable;
            $table->integer('isFeatured')->default(1);
            $table->integer('status')->default(1);  
            $table->timestamps();
        });
    }

  
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};