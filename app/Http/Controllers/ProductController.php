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

    /**
     * @OA\Get(
     *     path="api/v1/products",
     *     summary="List Products",
     *     description="Retrieves a list of all products.",
     *     tags={"Products"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of product list",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="success",
     *                 description="Status message for the product retrieval request."
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="products",
     *                     type="array",
     *                     @OA\Items(ref="#/components/schemas/Product")
     *                 )
     *             )
     *         )
     *     )
     * )
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

    /**
     * @OA\Get(
     *     path="api/v1/products/{product}",
     *     summary="Get Product",
     *     description="Retrieves details of a single product.",
     *     tags={"Products"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         description="ID of the product",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of product details",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="success",
     *                 description="Status message for the product retrieval request."
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="product",
     *                     ref="#/components/schemas/Product"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
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

    /**
     * @OA\Put(
     *     path="api/v1/products/{product}",
     *     summary="Update Product",
     *     description="Updates an existing product.",
     *     tags={"Products"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         description="ID of the product to be updated",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="published"),
     *             @OA\Property(property="url", type="string", example="https://soluct.com.br"),
     *             @OA\Property(property="creator", type="string", example="User XYZ"),
     *             @OA\Property(property="product_name", type="string", example="Sushi"),
     *             @OA\Property(property="quantity", type="integer", example=3),
     *             @OA\Property(property="brands", type="string", example="Brand Name"),
     *             @OA\Property(property="categories", type="string", example="Health"),
     *             @OA\Property(property="labels", type="string", example="Food"),
     *             @OA\Property(property="cities", type="string", example="Passo Fundo"),
     *             @OA\Property(property="purchase_places", type="string", example="Shopping"),
     *             @OA\Property(property="stores", type="string", example="Sushi House"),
     *             @OA\Property(property="ingredients_text", type="string", example="Fish, Rice"),
     *             @OA\Property(property="traces", type="string", example="Traces Text"),
     *             @OA\Property(property="serving_size", type="string", example="1"),
     *             @OA\Property(property="serving_quantity", type="string", example="100g"),
     *             @OA\Property(property="nutriscore_score", type="integer", example="32"),
     *             @OA\Property(property="nutriscore_grade", type="string", example="A"),
     *             @OA\Property(property="main_category", type="string", example="Food"),
     *             @OA\Property(property="image_url", type="string", example="https://soluct.com/image")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful product update",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="success",
     *                 description="Status message for the product update request."
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="product",
     *                     ref="#/components/schemas/Product"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
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

    /**
     * @OA\Delete(
     *     path="api/v1/products/{product}",
     *     summary="Delete Product",
     *     description="Deletes a specified product.",
     *     tags={"Products"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         description="ID of the product to be deleted",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful deletion of the product",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="success",
     *                 description="Status message indicating the product was successfully deleted."
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 example={}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
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

    /**
     * @OA\Post(
     *     path="api/v1/products/sync",
     *     summary="Sync Products",
     *     description="Triggers a routine to import and sync products.",
     *     tags={"Products"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful initiation of sync process",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="success",
     *                 description="Status message indicating the sync request was successful."
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 example={}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Sync process failed"
     *     )
     * )
     */
    public function sync(): JsonResponse
    {
        $this->product_service->executeImportProductsRoutine();

        return response()->json(['message' => 'success', 'data' => []], Response::HTTP_OK);
    }
}
