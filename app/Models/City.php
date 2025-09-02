<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model {
    use HasFactory;

    protected static function booted() {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function areas(){
        return $this->hasMany(Area::class);
    }

    public function getRouteKeyName() {
        return 'slug'; // Tells Laravel to use slug instead of ID
    }
}
