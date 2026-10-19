<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(): View
    {
        $categories = Categories::orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Categories::create($this->validateCategory($request));

        return redirect()->route('categories.index')->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function show(Categories $category): View
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Categories $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Categories $category): RedirectResponse
    {
        $category->update($this->validateCategory($request));

        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categories $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso!');
    }

    /** @return array{name: string, description?: string|null} */
    private function validateCategory(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}
