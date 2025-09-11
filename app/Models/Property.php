<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model {
    use HasFactory;

    protected $fillable = [
        'title','slug','residence_types','category','property_types','furnish_types','sale_types',
        'construction_types','rooms','bathrooms','user_id','builder_id','property_age','facings',
        'city_id','area_id','description','keywords','location','rera',
        'year_build','total_area','towers','units','related_properties','amenities','furnishing',
        'possession_date','brokerage','status'
    ];
   
    protected static function booted() {
        static::creating(function ($property) {
            $property->slug = Str::slug($property->title);
        });
    }

    public function getUrlAttribute() {
        return route('properties.details', [
            'propertyUrl' => $this->category . '-' . Str::slug($this->title) . '-' . $this->id . '-' . Str::slug($this->area->name) . '-' . Str::slug($this->city->name)
        ]);
    }

    public function property_images(){
        return $this->hasMany(PropertyImage::class);
    }    

    public function property_details_images() {
        return $this->hasMany(PropertyImage::class, 'property_id', 'id')->orderBy('id', 'asc');;
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

    public function builder() {
        return $this->belongsTo(\App\Models\Builder::class, 'builder_id');
    }    

    public function savedUsers() {
        return $this->hasMany(\App\Models\SavedProperty::class, 'property_id');
    }

    public function visitedUsers() {
        return $this->hasMany(\App\Models\VisitedProperty::class, 'property_id');
    }

    public function mainImage() {
        return $this->hasOne(PropertyImage::class)->where('label', 'main');
    }

    public function videoImage() {
        return $this->hasOne(PropertyImage::class)->where('label', 'video');
    }

    public function elevationImage() {
        return $this->hasOne(PropertyImage::class)->where('label', 'elevation');
    }


}
