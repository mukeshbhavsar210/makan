<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function jobType(){
        return $this->belongsTo(JobType::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function bathroom(){
        return $this->belongsTo(Bathroom::class);
    }

    public function developer(){
        return $this->belongsTo(Developer::class);
    }

    public function amenityType(){
        return $this->belongsTo(Amenity::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function applications(){
        return $this->hasMany(JobApplication::class);
    }
}
