
<x-layouts::app title="Detalhes da categoria">
    <section lang="pt-BR">
        <h1>Detalhes da categoria</h1>

        <p><strong>Código:</strong> {{ $categorie->id }}</p>
        <p><strong>Nome:</strong> {{ $categorie->nome }}</p>
        <p><strong>Descrição:</strong> {{ $categorie-
        >descricao ?? 'Sem descrição' }}</p>
        <a href="{{ route('categories.edit', $categorie)
        }}">Editar</a>
        <a href="{{ route('categories.index') }}">Voltar</a>
    </section>
</x-layouts::app>