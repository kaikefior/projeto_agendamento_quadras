@csrf

<p>
    <label for="nome">Nome</label><br>
    <input type="text" id="nome" name="nome"
    value="{{ old('nome', $categorie->nome ?? '') }}" required maxlength="100">
</p>
    @error('nome')
        <p role="alert">{{ $message }}</p>
    @enderror
<p>
    <label for="descricao">Descrição (opcional)</label><br>
    <textarea id="descricao" name="descricao" rows="4" cols="40" maxlength="1000">{{ old('descricao', $categorie->descricao ?? '') }}</textarea>
</p>
@error('descricao')
    <p role="alert">{{ $message }}</p>
@enderror

<button type="submit">Salvar</button>
<a href="{{ route('categories.index') }}">Cancelar</a>