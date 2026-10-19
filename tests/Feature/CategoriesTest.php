<?php

use App\Models\Categories;
use App\Models\User;

test('guests cannot access category operations', function () {
    $category = Categories::create(['name' => 'Beach tennis']);

    foreach (['index', 'create', 'show', 'edit'] as $action) {
        $this->get(route('categories.'.$action, $category))->assertRedirect(route('login'));
    }

    $this->post(route('categories.store'), ['name' => 'Vôlei'])->assertRedirect(route('login'));
    $this->put(route('categories.update', $category), ['name' => 'Vôlei'])->assertRedirect(route('login'));
    $this->delete(route('categories.destroy', $category))->assertRedirect(route('login'));
    $this->assertDatabaseCount('categories', 1);
    $this->assertDatabaseHas('categories', ['name' => 'Beach tennis']);
});

test('authenticated users can manage a category through all screens', function () {
    $this->actingAs(User::factory()->create());
    $this->get(route('categories.index'))->assertOk()->assertSee('Nenhuma categoria cadastrada.');
    $this->get(route('categories.create'))->assertOk()->assertSee('name="name"', false);

    $this->post(route('categories.store'), [
        'name' => 'Beach tennis',
        'description' => 'Esporte na areia',
    ])->assertRedirect(route('categories.index'))->assertSessionHas('success');

    $category = Categories::sole();
    $this->assertDatabaseHas('categories', ['name' => 'Beach tennis', 'description' => 'Esporte na areia']);
    $this->get(route('categories.index'))->assertOk()->assertSee('Beach tennis');
    $this->get(route('categories.show', $category))->assertOk()->assertSee('Esporte na areia');
    $this->get(route('categories.edit', $category))->assertOk()->assertSee('Beach tennis');

    $this->put(route('categories.update', $category), [
        'name' => 'Futevôlei',
        'description' => null,
    ])->assertRedirect(route('categories.index'))->assertSessionHas('success');
    $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Futevôlei', 'description' => null]);
    $this->get(route('categories.show', $category))->assertOk()->assertSee('Sem descrição');

    $this->delete(route('categories.destroy', $category))->assertRedirect(route('categories.index'));
    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    $this->get(route('categories.show', $category))->assertNotFound();
});

test('invalid category data cannot be saved', function () {
    $this->actingAs(User::factory()->create());
    $this->post(route('categories.store'), ['name' => ''])->assertSessionHasErrors('name');
    $this->post(route('categories.store'), [
        'name' => str_repeat('a', 101),
        'description' => str_repeat('b', 1001),
    ])->assertSessionHasErrors(['name', 'description']);
    $this->assertDatabaseCount('categories', 0);

    $category = Categories::create(['name' => 'Beach tennis']);
    $this->put(route('categories.update', $category), ['name' => ''])->assertSessionHasErrors('name');
    $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Beach tennis']);
});
