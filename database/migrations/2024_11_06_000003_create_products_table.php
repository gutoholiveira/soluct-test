<?php

use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string(Product::CODE);
            $table->enum(Product::STATUS, ProductStatus::toArray());
            $table->timestamp(Product::IMPORTED_T);
            $table->text(Product::URL);
            $table->string(Product::CREATOR);
            $table->integer(Product::CREATED_T);
            $table->integer(Product::LAST_MODIFIED_T);
            $table->string(Product::PRODUCT_NAME);
            $table->string(Product::QUANTITY);
            $table->string(Product::BRANDS);
            $table->text(Product::CATEGORIES);
            $table->string(Product::LABELS);
            $table->string(Product::CITIES);
            $table->string(Product::PURCHASE_PLACES);
            $table->string(Product::STORES);
            $table->text(Product::INGREDIENTS_TEXT);
            $table->string(Product::TRACES);
            $table->string(Product::SERVING_SIZE);
            $table->string(Product::SERVING_QUANTITY);
            $table->integer(Product::NUTRISCORE_SCORE);
            $table->string(Product::NUTRISCORE_GRADE);
            $table->string(Product::MAIN_CATEGORY);
            $table->text(Product::IMAGE_URL);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
