<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function property_images(){
        return $this->hasMany(PropertyImage::class);
    }

    // public function amenities(){
    //     return $this->hasMany('App\Models\Amenity','id','amenities');
    // }

    public function view(){
        return $this->belongsTo(View::class);
    }

    public function jobType(){
        return $this->belongsTo(JobType::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function bathroom(){
        return $this->belongsTo(Bathroom::class);
    }

    public function builder(){
        return $this->belongsTo(Builder::class);
    }

    public function amenityType(){
        return $this->belongsTo(Amenity::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function saleType(){
        return $this->belongsTo(SaleType::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function applications(){
        return $this->hasMany(JobApplication::class);
    }
}
