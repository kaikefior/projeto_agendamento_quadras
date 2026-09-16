
<x-layouts::app title="Categories">
    <section lang="pt-BR">
        <h1>Categorias</h1>

        @if (session('sucesso'))
            <p role="status">
                {{ session('sucesso') }}
            </p>
        @endif

        <p>
            <a href="{{ route('categories.create') }}">Nova categoria</a>
        </p>

        <table>
            <caption>Lista de categorias cadastradas</caption>
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->id }}</td>
                        <td>{{ $categorie->nome }}</td>
                        <td>{{ $categorie->descricao ?? 'Sem descrição' }}</td>
                        <td>
                            <a href="{{ route('categories.show', $categorie) }}">Ver</a>
                            <a href="{{ route('categories.edit', $categorie) }}">Editar</a>

                            <form action="{{ route('categories.destroy', $categorie) }}" method="POST" onsubmit="return confirm('Deseja excluir esta categoria?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhuma categoria cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</x-layouts::app>