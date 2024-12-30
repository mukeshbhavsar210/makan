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
            $table->string('name');
            $table->string('slug');
            $table->foreignId('age_id')->nullable()->constrained()->onDelete('cascade');     
            $table->foreignId('area_id')->constrained()->onDelete('cascade');
            $table->foreignId('bhk_type_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');            
            $table->foreignId('developer_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('facing_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('listing_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('sale_types_id')->nullable()->constrained()->onDelete('cascade');            
            $table->double('price',10,2);
            $table->double('compare_price',10,2)->nullable();            
            $table->enum('is_featured', ['Yes', 'No'])->default('No');
            $table->string('cover_photo')->nullable();
            $table->string('property_images')->nullable();
            $table->string('address')->nullable();
            $table->string('launch_date')->nullable();            
            $table->string('possession_date')->nullable();
            $table->string('possession_status')->nullable();
            $table->string('contact_seller')->nullable();
            $table->string('google_location')->nullable();
            $table->string('size')->nullable();
            $table->string('area')->nullable();
            $table->string('rera')->nullable();
            $table->text('content')->nullable();
            $table->json('nearby_places')->nullable();
            $table->json('amenities')->nullable();
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
