
<x-layouts::app title="Novo item">
    <section lang="pt-BR" class="mx-auto w-full max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                Novo item
            </h1>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Cadastre equipamentos, bebidas e lanches no inventário.
            </p>
        </div>

        <form
            action="{{ route('inventory.store') }}"
            method="POST"
            class="space-y-6"
        >
            @csrf

            <flux:input
                name="name"
                label="Nome do item"
                :value="old('name')"
                placeholder="Ex.: Bola de vôlei"
                maxlength="255"
                required
            />

            <div class="space-y-2">
                <label for="type" class="block text-sm font-medium">
                    Tipo
                </label>

                <select
                    id="type"
                    name="type"
                    class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white"
                    required
                >
                    <option
                        value="equipment"
                        @selected(old('type', 'equipment') === 'equipment')
                    >
                        Equipamento
                    </option>

                    <option
                        value="drink"
                        @selected(old('type') === 'drink')
                    >
                        Bebida
                    </option>

                    <option
                        value="snack"
                        @selected(old('type') === 'snack')
                    >
                        Lanche
                    </option>
                </select>
            </div>

            <flux:textarea
                name="description"
                label="Descrição (opcional)"
                placeholder="Descreva o item"
                maxlength="1000"
            >{{ old('description') }}</flux:textarea>

            <flux:input
                type="number"
                name="quantity"
                label="Quantidade"
                :value="old('quantity', 0)"
                min="0"
                step="1"
                required
            />

            <flux:input
                type="number"
                name="unit_price"
                label="Preço unitário em R$ (opcional)"
                :value="old('unit_price')"
                min="0"
                max="99999999.99"
                step="0.01"
                placeholder="Ex.: 5,50"
            />

            @if ($errors->any())
                <ul
                    role="alert"
                    class="list-inside list-disc text-sm text-red-600 dark:text-red-400"
                >
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="flex items-center justify-end gap-4">
                <a
                    href="{{ route('inventory.index') }}"
                    class="text-sm font-medium hover:underline"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800"
                >
                    Salvar item
                </button>
            </div>
        </form>
    </section>
</x-layouts::app>
