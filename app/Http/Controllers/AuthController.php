<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private AuthService $auth_service) {}

    /**
     * Make the customer or store login
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */

    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="User Login",
     *     description="Authenticate a user and returns the token if successful.",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 example="user@example.com",
     *                 description="The email address of the user."
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 example="securePassword123",
     *                 description="The user's password."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="success",
     *                 description="Status message for the login request."
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="token",
     *                     type="string",
     *                     example="2|WLjE7vP6qEU10snFG2wfzSE1drw8zlc6JHgMppO5dc8677b5",
     *                     description="Authentication token for the user."
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function login(Request $request): JsonResponse
    {
        $token = $this->auth_service->login($request->email, $request->password);

        return response()->json(['message' => 'success', 'data' => ['token' => $token]], Response::HTTP_OK);
    }

    /**
     * Make the logout
     *
     * @return JsonResponse
     */

    /**
     * @OA\Post(
     *     path="/api/v1/auth/logout",
     *     summary="User Logout",
     *     description="Logout the authenticated user by invalidating their token.",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="success",
     *                 description="Status message for the logout request."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized - Token required or invalid",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthorized",
     *                 description="Error message indicating an invalid or missing token."
     *             )
     *         )
     *     )
     * )
     */
    public function logout(): JsonResponse
    {
        $this->auth_service->logout(Auth::user());

        return response()->json(['message' => 'success'], Response::HTTP_OK);
    }
}
