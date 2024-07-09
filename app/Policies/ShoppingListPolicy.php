<?php

namespace App\Policies;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShoppingListPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ShoppingList $shoppingList): bool
    {
        return $user->id === $shoppingList->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ShoppingList $shoppingList): bool
    {
        return $user->id === $shoppingList->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ShoppingList $shoppingList): bool
    {
        return $user->id === $shoppingList->user_id;
    }
}
