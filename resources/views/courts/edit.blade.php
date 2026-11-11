
<x-layouts::app title="Editar quadra">
    <section lang="pt-BR" class="mx-auto w-full max-w-2xl space-y-6">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
            Editar quadra
        </h1>

        <form
            action="{{ route('courts.update', $court) }}"
            method="POST"
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            <flux:input
                name="name"
                label="Nome da quadra"
                :value="old('name', $court->name)"
                placeholder="Quadra 1"
                required
            />

            <flux:input
                name="sport_type"
                label="Modalidade"
                :value="old('sport_type', $court->sport_type)"
                placeholder="FutVôlei, Vôlei de Praia"
                required
            />

            <flux:textarea
                name="description"
                label="Descrição"
                placeholder="Descreva a quadra"
            >{{ old('description', $court->description) }}</flux:textarea>

            <div class="space-y-2">
                <label for="status" class="block text-sm font-medium">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-zinc-900 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white"
                    required
                >
                    <option
                        value="available"
                        @selected(old('status', $court->status) === 'available')
                    >
                        Disponível
                    </option>

                    <option
                        value="unavailable"
                        @selected(old('status', $court->status) === 'unavailable')
                    >
                        Indisponível
                    </option>
                </select>
            </div>

            @if ($errors->any())
                <ul role="alert" class="list-inside list-disc text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="flex items-center justify-end gap-4">
                <a
                    href="{{ route('courts.index') }}"
                    class="text-sm font-medium hover:underline"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800"
                >
                    Salvar alterações
                </button>
            </div>
        </form>
    </section>
</x-layouts::app>
