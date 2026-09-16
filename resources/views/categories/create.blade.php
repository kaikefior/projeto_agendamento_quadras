
<x-layouts::app title="Nova categoria">
    <section lang="pt-BR">
        <h1>Nova categoria</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @include('categorias.form')
        </form>
    </section>
</x-layouts::app>