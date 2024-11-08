<?php

namespace App\Services;

use App\Contracts\Services\IUserService;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    public function index(): Collection
    {
        return User::all();
    }

    public function store(UserRequest $request): User
    {
        return User::create([
            User::NAME     => $request->name,
            User::EMAIL    => $request->email,
            User::PASSWORD => Hash::make($request->password),
        ]);
    }

    public function update(UserRequest $request, User $user): User
    {
        $user->update([
            User::NAME  => $request->name,
            User::EMAIL => $request->email,
        ]);

        $user->refresh();

        return $user;
    }

    public function destroy(User $user): void
    {
        $user->delete();
    }
}
