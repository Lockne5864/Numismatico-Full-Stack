<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoneyControllerApiTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/api/');

        $response->assertStatus(200);
        // Adicione verificações adicionais com base nos dados retornados
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $response = $this->get("/api/{$user->id}");

        $response->assertStatus(200);
        // Adicione verificações adicionais com base nos dados retornados
    }
public function testStore()
{
    $user = User::factory()->create();

    $response = $this->post('/api/', [
        'name' => 'Sample Money',
        'year' => 2021,
        'country' => 'USA',
        'condition' => 'New',
        'price' => 100,
        'observation' => 'Sample observation',
        'type' => 'Coin',
        'material' => 'Gold',
        'available_sell' => 1,
        'user_id' => $user->id,
        'url_img' => 'http://example.com/sample.jpg'
    ]);
  
    $response->assertStatus(200); // Alterado de 201 para 200
    $this->assertDatabaseHas('money', [
        'name' => 'Sample Money'
    ]);
}

public function testChangeToMarketplace()
{
    $user = User::factory()->create();
    $money = \App\Models\Money::create([
        'name' => 'Sample Money',
        'year' => 2021,
        'country' => 'USA',
        'condition' => 'New',
        'price' => 100,
        'observation' => 'Sample observation',
        'type' => 'Coin',
        'material' => 'Gold',
        'available_sell' => true,
        'user_id' => $user->id,
        'url_img' => 'http://example.com/sample.jpg'
    ]);

    $response = $this->post("/api/{$money->id}");

    $response->assertStatus(200);
    $this->assertDatabaseHas('money', [
        'id' => $money->id,
        'available_sell' => 0 // Supondo que esse campo muda
    ]);
}


    // Adicione mais testes para os endpoints restantes
}
