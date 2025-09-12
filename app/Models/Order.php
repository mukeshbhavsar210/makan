<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model {
    use HasFactory;

     protected $fillable = [
        'property_id',
        'plan_id',
        'amount',
        'status',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
    ];

    public function property() {
        return $this->belongsTo(Property::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

     public function property_images(){
        return $this->hasMany(PropertyImage::class);
    }   
    
}
