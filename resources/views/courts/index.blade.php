<x-layouts::app title="Quadras">
    <section lang="pt-BR" class="mx-auto w-full max-w-5xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                    Quadras
                </h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    Gerencie suas quadras esportivas.
                </p>
            </div>

            <a
                href="{{ route('courts.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800"
            >
                + Nova quadra
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
                    Lista de quadras cadastradas
                </caption>

                <thead class="bg-zinc-50 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                    <tr>
                        <th scope="col" class="px-6 py-4">Código</th>
                        <th scope="col" class="px-6 py-4">Nome</th>
                        <th scope="col" class="px-6 py-4">Modalidade</th>
                        <th scope="col" class="px-6 py-4">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse ($courts as $court)
                        <tr class="text-zinc-700 hover:bg-zinc-50 dark:text-zinc-300 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4">
                                {{ $court->id }}
                            </td>
                            <td class="px-6 py-4 font-medium text-zinc-900 dark:text-white">
                                {{ $court->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $court->sport_type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $court->status }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <p class="font-medium text-zinc-900 dark:text-white">
                                    Nenhuma quadra cadastrada.
                                </p>
                                <p class="mt-2 text-zinc-500 dark:text-zinc-400">
                                    Clique em “Nova quadra” para começar.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-layouts::app>
