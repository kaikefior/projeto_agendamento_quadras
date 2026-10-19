<x-layouts::app title="Categorias">
    <section lang="pt-BR" class="mx-auto w-full max-w-5xl space-y-6">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                    Categorias
                </h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    Gerencie as modalidades esportivas das suas quadras.
                </p>
            </div>

            <a
                href="{{ route('categories.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800"
            >
                + Nova categoria
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
                    Lista de categorias cadastradas
                </caption>

                <thead class="bg-zinc-50 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                    <tr>
                        <th scope="col" class="px-6 py-4">Código</th>
                        <th scope="col" class="px-6 py-4">Nome</th>
                        <th scope="col" class="px-6 py-4">Descrição</th>
                        <th scope="col" class="px-6 py-4">Ações</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse ($categories as $category)
                        <tr class="text-zinc-700 hover:bg-zinc-50 dark:text-zinc-300 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4">
                                {{ $category->id }}
                            </td>

                            <td class="px-6 py-4 font-medium text-zinc-900 dark:text-white">
                                {{ $category->name }}
                            </td>

                            <td class="max-w-sm break-words px-6 py-4">
                                {{ $category->description ?? 'Sem descrição' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a
                                        href="{{ route('categories.show', $category) }}"
                                        class="font-medium text-emerald-700 hover:underline dark:text-emerald-400"
                                    >
                                        Ver
                                    </a>

                                    <a
                                        href="{{ route('categories.edit', $category) }}"
                                        class="font-medium text-blue-700 hover:underline dark:text-blue-400"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Deseja excluir esta categoria?')"
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
                            <td colspan="4" class="px-6 py-12 text-center">
                                <p class="font-medium text-zinc-900 dark:text-white">
                                    Nenhuma categoria cadastrada.
                                </p>
                                <p class="mt-2 text-zinc-500 dark:text-zinc-400">
                                    Clique em “Nova categoria” para começar.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-layouts::app>