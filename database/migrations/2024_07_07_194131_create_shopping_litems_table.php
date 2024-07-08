<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use \App\Models\ShoppingList;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shopping_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ShoppingList::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->decimal('quantity', 6, 3);
            $table->string('unit')->nullable();
            $table->boolean('checked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_items');
    }
};
