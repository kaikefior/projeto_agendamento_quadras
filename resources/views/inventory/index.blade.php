<x-layouts::app title="Inventário">
    <section lang="pt-BR" class="mx-auto w-full max-w-5xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                    Inventário
                </h1>

                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    Gerencie os equipamentos, bebidas e lanches do estabelecimento.
                </p>
            </div>

            <a
                href="{{ route('inventory.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800"
            >
                + Novo item
            </a>
        </div>

        @if (session('success'))
            <div
                role="status"
                class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-200"
            >
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            <table class="w-full text-left text-sm">
                <caption class="sr-only">
                    Lista de itens do inventário
                </caption>

                <thead class="bg-zinc-50 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                    <tr>
                        <th scope="col" class="px-6 py-4">Código</th>
                        <th scope="col" class="px-6 py-4">Nome</th>
                        <th scope="col" class="px-6 py-4">Tipo</th>
                        <th scope="col" class="px-6 py-4">Quantidade</th>
                        <th scope="col" class="px-6 py-4">Preço unitário</th>
                        <th scope="col" class="px-6 py-4">Ações</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse ($items as $item)
                        <tr class="text-zinc-700 hover:bg-zinc-50 dark:text-zinc-300 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4">
                                {{ $item->id }}
                            </td>

                            <td class="px-6 py-4 font-medium text-zinc-900 dark:text-white">
                                {{ $item->name }}
                            </td>

                            <td class="px-6 py-4">
                                @switch($item->type)
                                    @case('equipment')
                                        Equipamento
                                        @break

                                    @case('drink')
                                        Bebida
                                        @break

                                    @case('snack')
                                        Lanche
                                        @break

                                    @default
                                        {{ $item->type }}
                                @endswitch
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->quantity }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($item->unit_price !== null)
                                    R$ {{ number_format($item->unit_price, 2, ',', '.') }}
                                @else
                                    Não informado
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a
                                        href="{{ route('inventory.show', $item) }}"
                                        class="font-medium text-emerald-700 hover:underline dark:text-emerald-400"
                                    >
                                        Ver
                                    </a>

                                    <a
                                        href="{{ route('inventory.edit', $item) }}"
                                        class="font-medium text-blue-700 hover:underline dark:text-blue-400"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('inventory.destroy', $item) }}"
                                        method="POST"
                                        onsubmit="return confirm('Deseja excluir este item?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="cursor-pointer font-medium text-red-700 hover:underline dark:text-red-400"
                                        >
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <p class="font-medium text-zinc-900 dark:text-white">
                                    Nenhum item cadastrado.
                                </p>

                                <p class="mt-2 text-zinc-500 dark:text-zinc-400">
                                    Clique em “Novo item” para começar.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-layouts::app>