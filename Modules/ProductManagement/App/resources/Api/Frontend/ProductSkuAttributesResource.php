<?php

namespace Modules\ProductManagement\App\resources\Api\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSkuAttributesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'skuId' => $this->sku_id,
            'value' => $this->value_translated,
        ];
    }
}
