<?php

namespace Modules\ProductManagement\App\resources\Api\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ReviewManagement\App\resources\Api\Frontend\ReviewResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        /**prepare variants array related to skus*/
        $attributes = $this->attributes;
        $skuAttributes = $this->skuAttributes;
        $variants = [
            'sku' => ProductSkusResource::collection($this->skus)
        ];
        foreach($attributes as $attribute){
            $variants[$attribute->name['en']] = ProductSkuAttributesResource::collection( $skuAttributes->where('attribute_id',  $attribute->id));
        }
        /**prepare variants array related to skus*/

        return [
            'id' => $this->id,
            'name' => $this->name_translated,
            'description' => $this->description_translated,
            'thumbnail' => $this->thumbnail_path,
            'price' => $this->price,
            'discountRounded' => $this->discount_rounded,
            'priceAfterDiscount' => $this->price_after_discount,
            'stockAmount' => $this->stock_amount,
            'rate' => round($this->rate,1),
            'availableVariantsAttributes' => $attributes->pluck('name.en')->toarray(),
            'variants' => $variants,
        ];
    }
}
