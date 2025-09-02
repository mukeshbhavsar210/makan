<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Area extends Model {
    use HasFactory;

    protected static function booted() {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    // public function properties() {
    //     return $this->hasMany(Property::class);
    // }

    public function properties() {
        return $this->hasMany(Property::class, 'area_id', 'id');
    }
}
