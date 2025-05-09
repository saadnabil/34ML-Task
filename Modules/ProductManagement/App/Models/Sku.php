<?php

namespace Modules\ProductManagement\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\OrderManagement\App\Models\OrderDetails;
use Modules\ProductManagement\Database\factories\SkuFactory;

class Sku extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function skuAttributes(){
        return $this->hasMany(SkuAttribute::class);
    }

    /**accessors & mutators */
    public function getDiscountRoundedAttribute(){
        return floor($this->attributes['discount']);
    }
    /**accessors & mutators */

    public function orderDetails(){
        return $this->hasMany(OrderDetails::class);
    }

    protected static function newFactory(): SkuFactory
    {
        //return SkuFactory::new();
    }

}
