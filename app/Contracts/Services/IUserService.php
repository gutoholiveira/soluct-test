<?php

namespace App\Contracts\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserService
{
    /**
     * Get all users
     *
     * @return Collection
     */
    public function index(): Collection;

    /**
     * Store user
     *
     * @param UserRequest $request
     * @return User
     */
    public function store(UserRequest $request): User;

    /**
     * Update user
     *
     * @param UserRequest $request
     * @param User $user
     * @return User
     */
    public function update(UserRequest $request, User $user): User;

    /**
     * Delete user
     *
     * @param User $user
     * @return void
     */
    public function destroy(User $user): void;
}
