<?php

namespace Modules\ProductManagement\App\Services\Frontend;

use Illuminate\Database\Eloquent\Collection;
use Modules\ProductManagement\App\Http\Requests\Api\Frontend\FilterRequest;
use Modules\ProductManagement\App\Models\Product;

class ProductsService
{

    public function showProduct(Product $product)
    {
        return $product->load([
            'attributes',
            'skus',
            'skuAttributes'
        ]);
    }

    public function list($paginate)
    {

        $products = Product::with('skuAttributes');


        $products->when(request('options'), function ($q, $options) {
            $optionsArray = explode(',', $options);
            
            $q->whereHas('skus.skuAttributes', function ($query) use ($optionsArray) {
                $query->where(function ($q2) use ($optionsArray) {
                    foreach ($optionsArray as $value) {
                        $q2->orWhere('value->en', 'like', "%$value%");
                    }
                });
            });
        });

        $products->when(request('maxPrice'), function ($q, $maxPrice) {
            $q->whereHas('skus', function ($skuQ) use ($maxPrice) {
                $skuQ->where('price_after_discount', '<=', $maxPrice);
            });
        });

        $products->when(request('averageRate'), function ($q, $averageRate) {
            $q->where('rate', '=' , $averageRate);
        });

         $products->when(request('minPrice'), function ($q, $minPrice) {
            $q->whereHas('skus', function ($skuQ) use ($minPrice) {
                $skuQ->where('price_after_discount', '>=', $minPrice);
            });
        });

        return $products->latest()->paginate($paginate);
    }
}
