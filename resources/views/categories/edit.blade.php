
<x-layouts::app title="Editar categoria">
    <section lang="pt-BR">
        <h1>Editar categoria</h1>
        <form action="{{ route('categories.update', $categorie) }}" method="POST">
        @method('PUT')
        @include('categories.form')
        </form>
    </section>
</x-layouts::app>