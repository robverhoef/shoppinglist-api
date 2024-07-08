<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

use App\Models\ShoppingItem;
use App\Http\Controllers\Controller;
use App\Models\ShoppingList;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Gate;

class ShoppingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShoppingList $shopping_list): Collection|Response
    {
        $response = Gate::inspect('view', $shopping_list);
        if ($response->allowed() === false) {
            return response(['message' => $response->message()], 403);
        }
        return $shopping_list->items;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ShoppingList $shopping_list): ShoppingItem
    {
        $response = Gate::inspect('Update', $shopping_list);
        if ($response->allowed() === false) {
            return response(['message' => $response->message()], 403);
        }
        $field = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'unit' => 'nullable|string',
            'checked' => 'nullable|boolean',
        ]);
        $item = $shopping_list->items()->create($field);
        return $item;
    }

    /**
     * Display the specified resource.
     */
    public function show(Shoppinglist $shopping_list, ShoppingItem $item): ShoppingItem|Response
    {
        $response = Gate::inspect('view', $item);
        if ($response->allowed() === false) {
            return response(['message' => $response->message()], 403);
        }
        return $item;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shoppinglist $shopping_list, ShoppingItem $item): ShoppingItem|Response
    {
        $response = Gate::inspect('update', $shopping_list);
        if ($response->allowed() === false) {
            return response(['message' => $response->message()], 403);
        }

        $fields = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'unit' => 'nullable|string',
            'checked' => 'nullable|boolean',
        ]);
        $item->update($request->only(['name', 'quantity', 'unit', 'checked']));
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingList $shopping_list, ShoppingItem $item): ResponseFactory|Response
    {
        $response = Gate::inspect('delete', $item);
        if ($response->allowed() === false) {
            return response(['message' => $response->message()], 403);
        }

        $item->delete();
        return response(null, 204);
    }
}
