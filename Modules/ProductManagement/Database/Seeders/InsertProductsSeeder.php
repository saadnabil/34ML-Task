<?php

namespace Modules\ProductManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\ProductManagement\App\Models\Attribute;
use Modules\ProductManagement\App\Models\AttributeValue;
use Modules\ProductManagement\App\Models\Product;
use Modules\ProductManagement\App\Models\ProductAttribute;
use Modules\ProductManagement\App\Models\Sku;
use Modules\ProductManagement\App\Models\SkuAttribute;

class InsertProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        AttributeValue::truncate();
        Attribute::truncate();
        DB::table('product_attributes')->truncate();
        DB::table('sku_attributes')->truncate();
        DB::table('skus')->truncate();
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Add Attributes
        $colorAttribute = Attribute::firstOrCreate(['name' => ['en' => 'Color', 'ar' => 'لون']]);
        $sizeAttribute = Attribute::firstOrCreate(['name' => ['en' => 'Size', 'ar' => 'حجم']]);


        $colorAttributeValues = [
            ['en' => 'white', 'ar' => 'ابيض'],
            ['en' => 'red', 'ar' => 'احمر'],
            ['en' => 'green', 'ar' => 'اخضر'],
            ['en' => 'yellow', 'ar' => 'اصفر'],
            ['en' => 'black', 'ar' => 'اسود'],
        ];

        $sizeAttributeValues = [
            ['en' => 'Small', 'ar' => 'صغير'],
            ['en' => 'Medium', 'ar' => 'متوسط'],
            ['en' => 'Large', 'ar' => 'كبير'],
        ];


        // Create 20 Products per Brand
        for ($p = 1; $p <= 20; $p++) {
            $price = rand(100, 1000);
            $priceAfterDiscount = $price - rand(10, 100);

            $product = Product::create([
                'name' => ['en' => "Product $p", 'ar' => "منتج $p"],
                'description' => ['en' => "Description for product $p", 'ar' => "وصف للمنتج $p"],
                'price' => $price,
                'price_after_discount' => $priceAfterDiscount,
                'stock_amount' => rand(10, 100),
                'rate' => rand(0,5),
                'seller_sku' => fake()->unique()->bothify('SKU-###??'),
                'thumbnail' => "https://i.postimg.cc/TwbrDTrM/Hdd94f2f3dedf43ea8c70d13d94219eb2o.jpg",
            ]);


            // Add Attributes to Product
            ProductAttribute::create(['product_id' => $product->id, 'attribute_id' => $colorAttribute->id]);
            ProductAttribute::create(['product_id' => $product->id, 'attribute_id' => $sizeAttribute->id]);


            // Pick 3 random values for each attribute
            $colors = collect($colorAttributeValues)->random(3);
            $sizes = collect($sizeAttributeValues)->random(3);


            // Add SKUs
            foreach ($colors as $color) {
                foreach ($sizes as $size) {
                    $sku = Sku::create([
                        'sku' => Str::random(10),
                        'product_id' => $product->id,
                        'price' => $price,
                        'price_after_discount' => $priceAfterDiscount,
                        'stock_amount' => rand(5, 20),
                    ]);

                    // Assign SKU Attributes
                    SkuAttribute::create(['sku_id' => $sku->id, 'attribute_id' => $colorAttribute->id, 'value' => $color]);
                    SkuAttribute::create(['sku_id' => $sku->id, 'attribute_id' => $sizeAttribute->id, 'value' => $size]);
                }
            }


            // Add Product Details
            $details = [
                ['key' => ['en' => 'Brand', 'ar' => 'علامة تجارية'], 'value' => ['en' => 'Brand X', 'ar' => 'الماركة X']],
                ['key' => ['en' => 'Warranty', 'ar' => 'الضمان'], 'value' => ['en' => '2 Years', 'ar' => 'سنتان']],
                ['key' => ['en' => 'Made In', 'ar' => 'صنع في'], 'value' => ['en' => 'USA', 'ar' => 'الولايات المتحدة']],
                ['key' => ['en' => 'Material', 'ar' => 'المادة'], 'value' => ['en' => 'Leather', 'ar' => 'جلد']],
            ];

        }
    }
}
