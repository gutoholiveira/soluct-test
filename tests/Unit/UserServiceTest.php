<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected UserService $user_service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user_service = new UserService();
        User::factory()->count(3)->create();
    }

    public function test_return_all_users()
    {
        $users = $this->user_service->index();

        $this->assertCount(3, $users);
    }

    public function test_store_new_user()
    {
        $data = (object) [
            User::NAME     => 'John Doe',
            User::EMAIL    => 'johndoe@example.com',
            User::PASSWORD => 'password123',
        ];

        $user = $this->user_service->store($data);

        $this->assertEquals($user->name, 'John Doe');
        $this->assertEquals($user->email, 'johndoe@example.com');
    }

    public function test_update_user()
    {

        $user = User::where(User::ID, '>', 0)->first();

        $data = (object) [
            User::NAME  => 'Jane Smith',
            User::EMAIL => 'janesmith@example.com',
        ];

        $updatedUser = $this->user_service->update($data, $user);

        $this->assertEquals('Jane Smith', $updatedUser->name);
        $this->assertEquals('janesmith@example.com', $updatedUser->email);

        $this->assertDatabaseHas('users', [
            User::ID    => $user->id,
            User::NAME  => 'Jane Smith',
            User::EMAIL => 'janesmith@example.com',
        ]);
    }

    public function test_delete_user()
    {
        $user = User::where(User::ID, '>', 0)->first();

        $this->user_service->destroy($user);

        $this->assertEmpty(User::find($user->id));
    }
}
