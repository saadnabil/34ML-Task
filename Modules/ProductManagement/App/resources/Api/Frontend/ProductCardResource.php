<?php

namespace Modules\ProductManagement\App\resources\Api\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
         return [
            'id' => $this->id,
            'name' => $this->name_translated,
            'thumbnail' => $this->thumbnail_path,
            'price' => $this->price,
            'discountRounded' => $this->discount_rounded,
            'priceAfterDiscount' => $this->price_after_discount,
            'rate' => $this->rate,
         ];
    }
}
