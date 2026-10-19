
<x-layouts::app title="Nova categoria">
    <section lang="pt-BR" class="mx-auto w-full max-w-2xl space-y-6">
        <a href="{{ route('categories.index') }}" class="inline-flex rounded text-sm font-medium text-emerald-700 hover:underline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-emerald-600 dark:text-emerald-400">
            &larr; Voltar para categorias
        </a>

        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Nova categoria</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Cadastre uma modalidade esportiva para organizar suas quadras.
            </p>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm sm:p-8 dark:border-zinc-700 dark:bg-zinc-900">
            @include('categories.form')
        </form>
    </section>
</x-layouts::app>
