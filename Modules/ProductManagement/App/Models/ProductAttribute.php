<?php

namespace Modules\ProductManagement\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ProductManagement\Database\factories\ProductAttributeFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];
    
    protected static function newFactory(): ProductAttributeFactory
    {
        //return ProductAttributeFactory::new();
    }
}
