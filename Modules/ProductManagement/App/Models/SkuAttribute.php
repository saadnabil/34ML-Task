<?php

namespace Modules\ProductManagement\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ProductManagement\Database\factories\SkuAttributeFactory;

class SkuAttribute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

      /**acccessors & mutators */

      public function setValueAttribute($value){
        $this->attributes['value'] = json_encode($value);
    }

 

    public function getValueAttribute(){
       return json_decode($this->attributes['value'],true);
    }

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }

   

    /**get columns translated regarding to language sent in header for frontend developers */
    public function getValueTranslatedAttribute(){
        return json_decode($this->attributes['value'],true)[app()->getLocale()];
    }

    /**acccessors & mutators */
    
    protected static function newFactory(): SkuAttributeFactory
    {
        //return SkuAttributeFactory::new();
    }
}
