<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ShoppingList;
use App\Models\ShoppingItem;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'The Other User',
            'email' => 'other@example.com',
        ]);
        ShoppingList::factory(4)->create(['user_id' => 1])->each(
            function (ShoppingList $shopping_list) {
                ShoppingItem::factory(8)->create([
                    'shopping_list_id' => $shopping_list->id
                ]);
            }
        );
    }
}
