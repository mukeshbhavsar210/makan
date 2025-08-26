<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model {
    use HasFactory;

    public function areas(){
        return $this->hasMany(Area::class);
    }

    public function getRouteKeyName() {
        return 'slug'; // Tells Laravel to use slug instead of ID
    }
}
