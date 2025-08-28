<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model {
    use HasFactory;

    public function property_images(){
        return $this->hasMany(PropertyImage::class);
    }    

    public function city() {
        return $this->belongsTo(\App\Models\City::class, 'city_id'); 
    }   

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function property_images_new() {
        return $this->hasMany(\App\Models\PropertyImage::class, 'property_id');
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function applications(){
        return $this->hasMany(PropertyApplication::class);
    }

    public function savedProprty(){
        return $this->hasMany(SavedProperty::class);
    }

    public function builder(){
        return $this->belongsTo(Builder::class);
    }

    // public function builder() {
    //     return $this->belongsTo(User::class, 'builder_id'); // builder info
    // }

    public function builderName() {
        return $this->hasMany(\App\Models\Builder::class, 'builder_id');
    }

    public function builders() {
        return $this->belongsTo(Builder::class, 'builder_id');
    }

}
