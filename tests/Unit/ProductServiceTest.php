<?php

use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductService;
use App\Enums\ProductStatus;
use App\Http\Requests\ProductRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductServiceTest extends TestCase
{
    use DatabaseTransactions;

    private ProductService $productService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productService = new ProductService();
        $this->productService->executeImportProductsRoutine();
    }

    public function test_get_all_products()
    {
        $products = $this->productService->getAllProducts();
        $this->assertInstanceOf(LengthAwarePaginator::class, $products);
        $this->assertEquals(30, $products->count());
    }

    public function test_update_product()
    {
        $request = new ProductRequest();
        $request->merge([Product::PRODUCT_NAME => 'Updated Product Name']);

        $product = Product::where(Product::CODE, '0000000000017')->first();

        $updatedProduct = $this->productService->update($product, $request);

        $this->assertEquals('Updated Product Name', $updatedProduct->product_name);
        $this->assertDatabaseHas('products', [Product::ID => $product->id, Product::PRODUCT_NAME => 'Updated Product Name']);
    }

    public function test_delete_product()
    {
        $product = Product::where(Product::CODE, '0000000000017')->first();

        $deletedProduct = $this->productService->delete($product);

        $this->assertEquals(ProductStatus::TRASH, $deletedProduct->status);
        $this->assertDatabaseHas('products', [Product::ID => $product->id, Product::STATUS => ProductStatus::TRASH]);
    }
}
