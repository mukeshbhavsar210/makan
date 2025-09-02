<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitedProperty extends Model {
    use HasFactory;

    protected $fillable = ['property_id', 'user_id'];

    public function property_saved () {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}