<?php

namespace Modules\ProductManagement\App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Modules\ProductManagement\App\Models\Product;
use Modules\ProductManagement\App\resources\Api\Frontend\ProductCardResource;
use Modules\ProductManagement\App\resources\Api\Frontend\ProductResource;
use Modules\ProductManagement\App\Services\Frontend\ProductsService;

class ProductsController extends Controller
{
   use ApiResponseTrait;
   protected $productsService;

   public function __construct(ProductsService $productsService)
   {
      $this->productsService =  $productsService;
   }

   /**list with filter */
   public function list()
   {
      $products = $this->productsService->list(request('paginate') ?? 10);
      return $this->sendResponse(resource_collection(ProductCardResource::collection($products)));
   }

   /**show product */
   public function show(Product $product)
   {
      $product = $this->productsService->showProduct($product);
      return $this->sendResponse(new ProductResource($product));
   }
}
