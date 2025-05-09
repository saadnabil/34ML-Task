<?php

namespace Modules\ProductManagement\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ProductManagement\Database\factories\AttributeFactory;

class Attribute extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function values(){
        return $this->hasMany(AttributeValue::class);
    }

    public function products(){
        return $this->belongsToMany(ProductAttribute::class);
    } 

    public function skuAttributes(){
        return $this->hasMany(SkuAttribute::class);
    }


    /**acccessors & mutators */

    public function setNameAttribute($name){
        $this->attributes['name'] = json_encode($name);
    }

 

    public function getNameAttribute(){
       return json_decode($this->attributes['name'],true);
    }

   

    /**get columns translated regarding to language sent in header for frontend developers */
    public function getNameTranslatedAttribute(){
        return json_decode($this->attributes['name'],true)[app()->getLocale()];
    }

    /**acccessors & mutators */
    
    protected static function newFactory(): AttributeFactory
    {
        //return AttributeFactory::new();
    }
}
