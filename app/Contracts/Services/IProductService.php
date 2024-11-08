<?php

namespace App\Contracts\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface IProductService
{
    /**
     * Download the product files.
     *
     * @return void
     */
    public function getJsonFileFromOpenFoodFacts(): void;

    /**
     * Convert compressed json to a normal json file
     *
     * @param string $filePath
     * @return void
     */
    public function convertGzToJson(string $filePath): void;

    /**
     * Import product data to the database
     *
     * @return void
     */
    function importOrUpdateProductsByJsonFile(): void;

    /**
     * Execute the methods to sync the products by a routine
     *
     * @return void
     */
    public function executeImportProductsRoutine(): void;

    /**
     * Get all products
     *
     * @return LengthAwarePaginator
     */
    public function getAllProducts(): LengthAwarePaginator;

    /**
     * Update a product
     *
     * @param Product $product
     * @param ProductRequest $request
     * @return Product
     */
    public function update(Product $product, ProductRequest $request): Product;

    /**
     * Update a product as deleted
     *
     * @param Product $product
     * @return Product
     */
    public function delete(Product $product): Product;
}
