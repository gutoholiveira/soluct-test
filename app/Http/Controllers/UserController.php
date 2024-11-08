<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(protected UserService $user_service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = $this->user_service->index();

        return response()->json(['message' => 'success', 'data' => UsersResource::collection($users)], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $this->user_service->store($request);

        return response()->json(['message' => 'success', 'data' => new UsersResource($user)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(['message' => 'success', 'data' => new UsersResource($user)], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $updated_user = $this->user_service->update($request, $user);

        return response()->json(['message' => 'success', 'data' => new UsersResource($updated_user)], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->user_service->destroy($user);

        return response()->json(['message' => 'success', 'data' => []], Response::HTTP_OK);
    }
}
