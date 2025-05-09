<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description')->nullable();
            $table->double('price');
            $table->double('discount')->storedAs('((price - price_after_discount) / price) * 100');
            $table->double('price_after_discount');
            $table->integer('stock_amount');
            $table->string('thumbnail')->nullable();
            $table->string('seller_sku')->nullable();
            $table->tinyinteger('published')->default(1);
            $table->tinyinteger('rate')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('products');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    }
};
