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
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sport_type' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:available,unavailable'],
        ]);

        Court::create($validated);

        return redirect()
        ->route('courts.index')
        ->with('success', 'Quadra cadastrada com sucesso!');
    }

    
    public function show(Court $court)
    {
        //
    }

    
    public function edit(Court $court)
    {
        //
    }

    
    public function update(Request $request, Court $court)
    {
        //
    }

    
    public function destroy(Court $court)
    {
        //
    }
}
