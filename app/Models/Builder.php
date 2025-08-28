<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Builder extends Model {
    use HasFactory;

    public function property(){
        return $this->belongsTo(Property::class);
    }

     public function properties() {
        return $this->hasMany(Property::class, 'builder_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
