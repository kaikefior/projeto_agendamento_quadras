<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    
    public function index()
    {
        $courts = Court::orderBy('name')->get();

        return view('courts.index', compact('courts'));
    }

    
    public function create()
    {
        return view('courts.create');
    }

    
    public function store(Request $request)
    {
        // Valida os dados enviados pelo formulário
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sport_type' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:available,unavailable'],
        ]);

        // Atualiza a quadra selecionada
        Court::create($validated);

        // Volta para a listagem com uma mensagem
        return redirect()
        ->route('courts.index')
        ->with('success', 'Quadra cadastrada com sucesso!');
    }

    
    public function show(Court $court)
    {
        return view('courts.show', compact('court'));
    }

    
    public function edit(Court $court)
    {
        // Envia a quadra selecionada para o formulário de edição.
        return view('courts.edit', compact('court'));
    }

    
    public function update(Request $request, Court $court)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sport_type' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:available,unavailable'],
        ]);

        $court->update($validated);

        return redirect()
        ->route('courts.index')
        ->with('success', 'Quadra atualizada com sucesso!');
    }

    
    public function destroy(Court $court)
    {
        // Impede excluir uma quadra que possui reservas.
        if ($court-> reservations ()-> exists()) {
            return redirect()
            ->route('courts.index')
            ->with('error', 'Esta quadra possui reservas e não pode ser excluída ');
        }

        //exclui a quadra do banco
        $court->delete();

        return redirect()
        ->route('courts.index')
        ->with('success', 'Quadra excluída com sucesso!');
        
    }
}
