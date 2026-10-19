
<x-layouts::app title="Detalhes da categoria">
    <section lang="pt-BR">
        <h1>Detalhes da categoria</h1>

        <p><strong>Código:</strong> {{ $category->id }}</p>
        <p><strong>Nome:</strong> {{ $category->name }}</p>
        <p><strong>Descrição:</strong> {{ $category->description ?? 'Sem descrição' }}</p>
        <a href="{{ route('categories.edit', $category)
        }}">Editar</a>
        <a href="{{ route('categories.index') }}">Voltar</a>
    </section>
</x-layouts::app>