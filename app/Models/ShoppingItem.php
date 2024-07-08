<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'unit', 'checked', 'shopping_lists_id'];

    public function shoppingList()
    {
        return $this->belongsTo(ShoppingList::class);
    }
}
