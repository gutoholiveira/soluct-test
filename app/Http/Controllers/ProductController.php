<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private ProductService $product_service) {}

    /**
     * Display a listing of the resource
     *
     * @return JsonResponse
     */
    public function index()
    {
        $products = $this->product_service->getAllProducts();

        return response()->json(['message' => 'success', 'data' => ['products' => ProductResource::collection($products)]], Response::HTTP_OK);
    }

    /**
     * Display the specified resource
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json(['message' => 'success', 'data' => ['product' => new ProductResource($product)]], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $updated_product = $this->product_service->update($product, $request);

        return response()->json(['message' => 'success', 'data' => ['product' => new ProductResource($updated_product)]], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->product_service->delete($product);

        return response()->json(['message' => 'success', 'data' => []], Response::HTTP_OK);
    }

    /**
     * Sync the products by a request
     *
     * @return JsonResponse
     */
    public function sync(): JsonResponse
    {
        $this->product_service->executeImportProductsRoutine();

        return response()->json(['message' => 'success', 'data' => []], Response::HTTP_OK);
    }
}
