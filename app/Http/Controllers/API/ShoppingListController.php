<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Database\Eloquent\Builder;

use App\Models\ShoppingList;
use App\Models\User;
use App\Http\Controllers\Controller;


class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        $user = User::find(auth()->id());
        return $user->shoppingLists()->orderBy('shopping_date', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): ShoppingList
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'shopping_date' => 'required|date',
        ]);
        $shoppingList = User::find(auth()->id())->shoppingLists()->create($fields);
        return $shoppingList;
    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingList $shoppingList): Collection|Response
    {
        $response = Gate::inspect('view', $shoppingList);
        if ($response->allowed() === false) {
            return response(['message' => $response->message()], 403);
        }

        return $shoppingList->with(['items' => function (Builder $query) {
            $query->orderBy('checked', 'asc');
        }])->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShoppingList $shoppingList): ShoppingList
    {
        $response = Gate::inspect('update', $shoppingList);
        if ($response->allowed() === false) {
            return response(['message' => $response->message()], 403);
        }

        $fields = $request->validate([
            'name' => 'required|string',
            'shopping_date' => 'required|date',
        ]);
        $shoppingList->update($fields);
        return $shoppingList;
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(ShoppingList $shoppingList): ResponseFactory|Response
    {
        $response = Gate::inspect('delete', $shoppingList);
        if ($response->allowed() === false) {
            return response(['message' => $response->message()], 403);
        }

        $shoppingList->delete();
        return response(null, 204);
    }
}
