<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //busca os items por ordem alfabetica
        $items = InventoryItem::orderBy('name')->get();

        //envia os items para a tela de listagem
        return view('inventory.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'type' => ['required', 'in:equipment,drink,snack'],
        'description' => ['nullable', 'string', 'max:1000'],
        'quantity' => ['required', 'integer', 'min:0'],
        'unit_price' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
        ]);

        InventoryItem::create($validated);

        return redirect()
         ->route('inventory.index')
         ->with('success', 'Item cadastrado com sucesso!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(InventoryItem $inventoryItem)
    {
        return view('inventory.show', compact('inventoryItem'));
    }

    
    public function edit(InventoryItem $inventoryItem)
    {
        return view('inventory.edit', compact('inventoryItem'));
    }

    
    public function update(Request $request, InventoryItem $inventoryItem)
    {
        $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'type' => ['required', 'in:equipment,drink,snack'],
        'description' => ['nullable', 'string', 'max:1000'],
        'quantity' => ['required', 'integer', 'min:0'],
        'unit_price' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
    ]);

        $inventoryItem->update($validated);

        return redirect()
        ->route('inventory.index')
        ->with('success', 'Item atualizado com sucesso!');

    }

    
    public function destroy(InventoryItem $inventoryItem)
    {
        $inventoryItem->delete();

        return redirect()
        ->route('inventory.index')
        ->with('success', 'Item excluído com sucesso!');
    }
}
