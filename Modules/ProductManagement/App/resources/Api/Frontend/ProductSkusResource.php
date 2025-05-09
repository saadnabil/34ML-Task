<?php

namespace Modules\ProductManagement\App\resources\Api\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSkusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'skuId' => $this->id,
            'sku' => $this->sku,
            'stockAmount' => $this->stock_amount,
            'price' => $this->price,
            'priceAfterDiscount' => $this->price_after_discount,
            'discountRounded' =>$this->discount_rounded,

        ];
    }
}
