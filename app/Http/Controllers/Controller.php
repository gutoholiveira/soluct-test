<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Soluct Test",
 *      description="Soluct Test API Description"
 * ),
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter the auth token"
 * ),
 * 
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     @OA\Property(
 *         property="code",
 *         type="string",
 *         description="Code"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="Status"
 *     ),
 *     @OA\Property(
 *         property="imported_t",
 *         type="datetime",
 *         description="Imported date"
 *     ),
 *     @OA\Property(
 *         property="url",
 *         type="string",
 *         description="Url"
 *     ),
 *     @OA\Property(
 *         property="creator",
 *         type="string",
 *         description="Product Creator"
 *     ),
 *     @OA\Property(
 *         property="created_t",
 *         type="integer",
 *         description="Created at"
 *     ),
 *     @OA\Property(
 *         property="last_modified_t",
 *         type="integer",
 *         description="Last modified at"
 *     ),
 *     @OA\Property(
 *         property="product_name",
 *         type="string",
 *         description="Product name"
 *     ),
 *     @OA\Property(
 *         property="quantity",
 *         type="string",
 *         description="Quantity"
 *     ),
 *     @OA\Property(
 *         property="brands",
 *         type="string",
 *         description="Brands"
 *     ),
 *     @OA\Property(
 *         property="categories",
 *         type="string",
 *         description="Categories"
 *     ),
 *     @OA\Property(
 *         property="labels",
 *         type="string",
 *         description="Labels"
 *     ),
 *     @OA\Property(
 *         property="cities",
 *         type="string",
 *         description="Cities"
 *     ),
 *     @OA\Property(
 *         property="purchase_places",
 *         type="string",
 *         description="Purchase Places"
 *     ),
 *     @OA\Property(
 *         property="stores",
 *         type="string",
 *         description="Stores"
 *     ),
 *     @OA\Property(
 *         property="ingredients_text",
 *         type="string",
 *         description="Ingredients"
 *     ),
 *     @OA\Property(
 *         property="traces",
 *         type="string",
 *         description="Traces"
 *     ),
 *     @OA\Property(
 *         property="serving_size",
 *         type="string",
 *         description="Serving Size"
 *     ),
 *     @OA\Property(
 *         property="serving_quantity",
 *         type="string",
 *         description="Serving Quantity"
 *     ),
 *     @OA\Property(
 *         property="nutriscore_score",
 *         type="integer",
 *         description="Nutriscore score"
 *     ),
 *     @OA\Property(
 *         property="nutriscore_grade",
 *         type="string",
 *         description="Nutriscore grade"
 *     ),
 *     @OA\Property(
 *         property="main_category",
 *         type="string",
 *         description="Main category"
 *     ),
 *     @OA\Property(
 *         property="image_url",
 *         type="string",
 *         description="Image url"
 *     ),
 * ),
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Id"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="Email"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="datetime",
 *         description="Created At"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="datetime",
 *         description="Updated At"
 *     ),
 * )
 */
abstract class Controller
{
    //
}
