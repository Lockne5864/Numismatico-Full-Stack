<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Collection;
use App\Models\Money;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollectionControllerApiTest extends TestCase
{
    use RefreshDatabase;

public function testIndex()
{
    $user = User::factory()->create();

    $collection = Collection::create([
        'name' => 'My Collection',
        'observation' => 'This is a sample collection.',
        'url_img' => 'http://example.com/sample.jpg',
        'user_id' => $user->id
    ]);

    $money1 = Money::create([
        'name' => 'Irã - 100 Rials (1974-1979) soberba-FE',
        'year' => 1979,
        'country' => 'Irã',
        'condition' => 'soberba-FE',
        'price' => '4.00',
        'observation' => 'Irã - 100 Rials (1974-1979) soberba-FE',
        'material' => 'papel',
        'available_sell' => 0,
        'url_img' => 'data:image/jpeg;base64,/9j/4',
        'user_id' => $user->id,
        'collection_id' => $collection->id
    ]);

    $money2 = Money::create([
        'name' => 'Mongólia - 1 Tugrik 1955 FE',
        'year' => 1955,
        'country' => 'Mongólia',
        'condition' => 'FE',
        'price' => '1.00',
        'observation' => '1 Tugrik 1955 FE',
        'material' => 'papel',
        'available_sell' => 1,
        'url_img' => 'data:image',
        'user_id' => $user->id,
        'collection_id' => $collection->id
    ]);

    $response = $this->get('/api/collection/' . $user->id . '/all');

    $response->assertStatus(200)
             ->assertJsonStructure([
                 'collection' => [
                     '*' => [
                         'id',
                         'name',
                         'observation',
                         'url_img',
                         'created_at',
                         'updated_at',
                         'moneys' => [
                             '*' => [
                                 'id',
                                 'name',
                                 'year',
                                 'country',
                                 'condition',
                                 'price',
                                 'observation',
                                 'type',
                                 'material',
                                 'available_sell',
                                 'url_img',
                                 'user_id',
                                 'created_at',
                                 'updated_at'
                             ]
                         ]
                     ]
                 ]
             ]);
}

public function testStore()
{
    $user = User::factory()->create();
    $collection = Collection::create([
        'name' => 'My Collection',
        'observation' => 'This is a sample collection.',
        'url_img' => 'http://example.com/sample.jpg',
        'user_id' => $user->id
    ]);
    $money1 = Money::create([
        'name' => 'Irã - 100 Rials (1974-1979) soberba-FE',
        'year' => 1979,
        'country' => 'Irã',
        'condition' => 'soberba-FE',
        'price' => '4.00',
        'observation' => 'Irã - 100 Rials (1974-1979) soberba-FE',
        'material' => 'papel',
        'available_sell' => 0,
        'url_img' => 'data:image/jpeg;base64,/9j/4',
        'user_id' => $user->id,
        'collection_id' => $collection->id
    ]);

    $money2 = Money::create([
        'name' => 'Mongólia - 1 Tugrik 1955 FE',
        'year' => 1955,
        'country' => 'Mongólia',
        'condition' => 'FE',
        'price' => '1.00',
        'observation' => '1 Tugrik 1955 FE',
        'material' => 'papel',
        'available_sell' => 1,
        'url_img' => 'data:image',
        'user_id' => $user->id,
        'collection_id' => $collection->id
    ]);

    $response = $this->post('/api/collection/' . $user->id . '/add', [
        'name' => 'My Collection',
        'observation' => 'This is a sample collection.',
        'url_img' => 'http://example.com/sample.jpg',
        'money_id'=> [$money1->id,$money2->id]
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('collections', [
        'name' => 'My Collection',
    ]);
}

public function testEdit()
{
    $user = User::factory()->create();

    $collection = Collection::create([
        'name' => 'My Collection',
        'observation' => 'This is a sample collection.',
        'url_img' => 'http://example.com/sample.jpg',
        'user_id' => $user->id
    ]);
  
    $money1 = Money::create([
        'name' => 'Irã - 100 Rials (1974-1979) soberba-FE',
        'year' => 1979,
        'country' => 'Irã',
        'condition' => 'soberba-FE',
        'price' => '4.00',
        'observation' => 'Irã - 100 Rials (1974-1979) soberba-FE',
        'material' => 'papel',
        'available_sell' => 0,
        'url_img' => 'data:image/jpeg;base64,/9j/4',
        'user_id' => $user->id,
        'collection_id' => $collection->id
    ]);

    $money2 = Money::create([
        'name' => 'Mongólia - 1 Tugrik 1955 FE',
        'year' => 1955,
        'country' => 'Mongólia',
        'condition' => 'FE',
        'price' => '1.00',
        'observation' => '1 Tugrik 1955 FE',
        'material' => 'papel',
        'available_sell' => 1,
        'url_img' => 'data:image',
        'user_id' => $user->id,
        'collection_id' => $collection->id
    ]);


    $response = $this->post("/api/collection/{$user->id}/{$collection->id}/edit", [
        'name' => 'Updated Collection',
        'observation' => 'This is an updated sample collection.',
        'url_img' => 'http://example.com/updated.jpg',
        'money_id'=> [$money1->id,$money2->id]
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('collections', [
        'name' => 'Updated Collection',
        'observation' => 'This is an updated sample collection.',
        'url_img' => 'http://example.com/updated.jpg'
    ]);
}
public function testShow()
{
    $user = User::factory()->create();

    $collection = Collection::create([
        'name' => 'My Collection',
        'observation' => 'This is a sample collection.',
        'url_img' => 'http://example.com/sample.jpg',
        'user_id' => $user->id
    ]);

    $response = $this->get("/api/collection/{$user->id}/{$collection->id}");

    $response->assertStatus(200)
             ->assertJson([
                 'collection' => [
                     'id' => $collection->id,
                     'name' => 'My Collection',
                     'observation' => 'This is a sample collection.',
                     'url_img' => 'http://example.com/sample.jpg',
                     'created_at' => $collection->created_at->toISOString(),
                     'updated_at' => $collection->updated_at->toISOString(),
                     'moneys' => []
                 ],
                 'status' => true
             ]);
}


}