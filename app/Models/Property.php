<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model {
    use HasFactory;

    public function property_images(){
        return $this->hasMany(PropertyImage::class);
    }    

    public function view(){
        return $this->belongsTo(View::class);
    }   

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function bathroom(){
        return $this->belongsTo(Bathroom::class);
    }

    public function construction(){
        return $this->belongsTo(Construction::class);
    }

    public function amenityType(){
        return $this->belongsTo(Amenity::class);
    }
    
    public function saleType(){
        return $this->belongsTo(SaleType::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // public function city(){
    //     return $this->belongsTo(City::class);
    // }

    public function city() {
        return $this->belongsTo(\App\Models\City::class, 'city_id'); 
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id'); 
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function property_images_new() {
        return $this->hasMany(\App\Models\PropertyImage::class, 'property_id');
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function propertyType(){
        return $this->belongsTo(PropertyType::class);
    }

    public function applications(){
        return $this->hasMany(PropertyApplication::class);
    }

    public function savedProprty(){
        return $this->hasMany(SavedProperty::class);
    }

    public function amenities() {
        return $this->belongsToMany(Amenity::class, 'amenity_property');
    }

    public function builder(){
        return $this->belongsTo(Builder::class);
    }

    public function builderName() {
        return $this->hasMany(\App\Models\Builder::class, 'builder_id');
    }

    public function builders() {
        return $this->belongsTo(Builder::class, 'builder_id');
    }

}
