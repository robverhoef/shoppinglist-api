<?php

namespace App\Policies;

use App\Models\ShoppingItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShoppingItemPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ShoppingItem $shoppingItem): bool
    {
        return $user->id === $shoppingItem->shoppingList()->first()->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ShoppingItem $shoppingItem): bool
    {
        return $user->id === $shoppingItem->shoppingList()->first()->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ShoppingItem $shoppingItem): bool
    {
        return $user->id === $shoppingItem->shoppingList()->first()->user_id;
    }
}
