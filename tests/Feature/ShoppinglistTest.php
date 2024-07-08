<?php

namespace Tests\Feature;


use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class ShoppinglistTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic feature test example.
     */
    public function test_list(): void
    {
        $this->seed();
        Sanctum::actingAs(User::find(1), ['*']);
        $response = $this->get('/api/v1/shopping-lists');
        $response->assertJsonCount(4);
    }
    public function test_items_list(): void
    {
        $this->seed();
        Sanctum::actingAs(User::find(1), ['*']);
        $response = $this->get('/api/v1/shopping-lists/1/items');
        $response->assertJsonCount(8);
    }
    public function test_item_updatable(): void
    {
        $this->seed();
        Sanctum::actingAs(User::find(1), ['*']);
        $response = $this->putJson('/api/v1/shopping-lists/1/items/1', [
            'name' => 'whatever',
            'quantity' => 1,
            'unit' => 'Kg',
            'checked' => true
        ]);
        $response->assertOK();
    }
    public function test_item_invalid_user(): void
    {
        $this->seed();
        Sanctum::actingAs(User::find(2), ['*']);
        $response = $this->get('/api/v1/shopping-lists/1/items/1');
        $response->assertStatus(403);
    }
}
