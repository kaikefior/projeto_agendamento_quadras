
<x-layouts::app title="Detalhes do item">
    <section lang="pt-BR" class="mx-auto w-full max-w-2xl space-y-6">
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
            Detalhes do item
        </h1>

        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <dl class="space-y-5">
                <div>
                    <dt class="text-sm text-zinc-500 dark:text-zinc-400">
                        Código
                    </dt>
                    <dd class="mt-1 text-zinc-900 dark:text-white">
                        {{ $inventoryItem->id }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500 dark:text-zinc-400">
                        Nome
                    </dt>
                    <dd class="mt-1 font-semibold text-zinc-900 dark:text-white">
                        {{ $inventoryItem->name }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500 dark:text-zinc-400">
                        Tipo
                    </dt>
                    <dd class="mt-1 text-zinc-900 dark:text-white">
                        @switch($inventoryItem->type)
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
                                {{ $inventoryItem->type }}
                        @endswitch
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500 dark:text-zinc-400">
                        Descrição
                    </dt>
                    <dd class="mt-1 whitespace-pre-line break-words text-zinc-900 dark:text-white">{{ $inventoryItem->description ?? 'Sem descrição' }}</dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500 dark:text-zinc-400">
                        Quantidade
                    </dt>
                    <dd class="mt-1 text-zinc-900 dark:text-white">
                        {{ $inventoryItem->quantity }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500 dark:text-zinc-400">
                        Preço unitário
                    </dt>
                    <dd class="mt-1 text-zinc-900 dark:text-white">
                        @if ($inventoryItem->unit_price !== null)
                            R$ {{ number_format($inventoryItem->unit_price, 2, ',', '.') }}
                        @else
                            Não informado
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        <div class="flex items-center justify-end gap-4">
            <a
                href="{{ route('inventory.index') }}"
                class="text-sm font-medium hover:underline"
            >
                Voltar
            </a>

            <a
                href="{{ route('inventory.edit', $inventoryItem) }}"
                class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800"
            >
                Editar item
            </a>
        </div>
    </section>
</x-layouts::app>