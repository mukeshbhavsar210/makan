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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('bhk_type_id')->constrained()->onDelete('cascade');            
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('area_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('developer_id')->constrained()->onDelete('cascade');
            $table->foreignId('sale_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('facing_id')->constrained()->onDelete('cascade');
            $table->double('price',10,2);
            $table->double('compare_price',10,2)->nullable();
            $table->enum('is_featured', ['Yes', 'No'])->default('No');
            $table->text('description')->nullable;
            $table->text('keywords')->nullable;
            $table->json('amenities')->nullable;
            $table->string('location');
            $table->string('size');            
            $table->integer('status')->default(1);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
