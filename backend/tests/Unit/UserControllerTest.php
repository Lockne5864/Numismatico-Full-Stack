<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $controller = new UserController();
        $request = Request::create('/users', 'GET');
        $response = $controller->index();

        $this->assertEquals(200, $response->status());
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $controller = new UserController();
        $response = $controller->show($user->id);

        $this->assertEquals(200, $response->status());

        $responseData = json_decode($response->getContent(), true);

        $this->assertIsArray($responseData);
        $this->assertArrayHasKey('id', $responseData);
        $this->assertArrayHasKey('name', $responseData);
        $this->assertArrayHasKey('email', $responseData);
        $this->assertEquals($user->id, $responseData['id']);
        $this->assertEquals($user->name, $responseData['name']);
        $this->assertEquals($user->email, $responseData['email']);
    }

    public function testStore()
    {
        $controller = new UserController();
        $request = Request::create('/users', 'POST', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response = $controller->store($request);

        $this->assertEquals(201, $response->status());
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $controller = new UserController();
        $request = Request::create("/users/{$user->id}", 'PUT', [
            'name' => 'Updated User'
        ]);

        $response = $controller->update($request, $user->id);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated User'
        ]);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $controller = new UserController();
        $response = $controller->destroy($user->id);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
}
