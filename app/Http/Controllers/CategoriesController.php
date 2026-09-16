<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Categories;

class CategoriesController extends Controller
{
   
    public function index()
    {
        $categories = categorie::all();
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        Categorie::create($this->validar($request));

        return redirect()->route('categories.index') -> with('success', 'Categoria cadastrada com sucesso!');
    }

    public function show(Categorie $categorie)
    {
        return view('categorie.show', compact('categoria'));
    }


    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categories'));
    }


    public function update(Request $request, string $id)
    {
        $categorie->update($this->validate($request));

        return redirect()->route('categorie.index')->with('success', 'Categoria atualizada com sucesso!');
    }


    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso');
    }

    private function validate(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description'=> ['nullable', 'string', 'max:1000'],
        ]);
    }
}
