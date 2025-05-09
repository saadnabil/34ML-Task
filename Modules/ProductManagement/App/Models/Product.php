<?php

namespace Modules\ProductManagement\App\Models;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Eloquent\Model;
use Modules\RateManagement\App\Models\Rate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ProductManagement\Database\factories\ProductFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function getThumbnailPathAttribute()
    {
        if (filter_var($this->attributes['thumbnail'], FILTER_VALIDATE_URL)) {
            // If the image is a valid URL, return it directly
            return $this->attributes['thumbnail'];
        } else {
            // If the image is not a URL, assume it's a file path and return it with the asset helper
            return $this->attributes['thumbnail'] != null ? url('storage/' . $this->attributes['thumbnail']) : null;
        }
    }

    public function skus(){
        return $this->hasMany(Sku::class);
    }

    public function attributes(){
        return $this->belongsToMany(Attribute::class, 'product_attributes');
    }

    public function skuAttributes()
    {
        return $this->hasManyThrough(SkuAttribute::class, Sku::class);
    }

   
    /**acccessors & mutators */

    public function setNameAttribute($name){
        $this->attributes['name'] = json_encode($name);
    }

    public function setDescriptionAttribute($description){
        $this->attributes['description'] = json_encode($description);
    }


    public function getNameAttribute(){
       return json_decode($this->attributes['name'],true);
    }


    public function getDiscountRoundedAttribute(){
        return floor($this->attributes['discount']);
     }

    public function getDescriptionAttribute(){
        return json_decode($this->attributes['description'],true);
    }

    /**get columns translated regarding to language sent in header for frontend developers */
    public function getNameTranslatedAttribute(){
        return json_decode($this->attributes['name'],true)[app()->getLocale()];
    }

    public function getDescriptionTranslatedAttribute(){
        return json_decode($this->attributes['description'],true)[app()->getLocale()];
    }

    /**acccessors & mutators */


    protected static function newFactory(): ProductFactory
    {
        //return ProductFactory::new();
    }
}
