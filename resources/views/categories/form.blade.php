@csrf

<div class="space-y-6">
    <div>
        <label for="name" class="mb-2 block text-sm font-medium text-zinc-900 dark:text-white">
            Nome <span class="font-normal text-zinc-500 dark:text-zinc-400">(obrigatório)</span>
        </label>
        <input
            type="text" id="name" name="name"
            value="{{ old('name', $category->name ?? '') }}"
            required maxlength="100" placeholder="Ex.: Beach tennis"
            aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
            @error('name') aria-describedby="name-error" @enderror
            class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-base text-zinc-900 placeholder:text-zinc-400 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 aria-invalid:border-red-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white"
        >
        @error('name')
            <p id="name-error" role="alert" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="mb-2 block text-sm font-medium text-zinc-900 dark:text-white">
            Descrição <span class="font-normal text-zinc-500 dark:text-zinc-400">(opcional)</span>
        </label>
        <textarea
            id="description" name="description" rows="4" maxlength="1000"
            placeholder="Descreva brevemente a modalidade."
            aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}"
            aria-describedby="description-hint{{ $errors->has('description') ? ' description-error' : '' }}"
            class="w-full resize-y rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-base text-zinc-900 placeholder:text-zinc-400 focus:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 aria-invalid:border-red-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white"
        >{{ old('description', $category->description ?? '') }}</textarea>
        <p id="description-hint" class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">Até 1.000 caracteres.</p>
        @error('description')
            <p id="description-error" role="alert" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col gap-3 border-t border-zinc-200 pt-6 sm:flex-row sm:justify-end dark:border-zinc-700">
        <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-semibold text-zinc-700 hover:bg-zinc-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">
            Cancelar
        </a>
        <button type="submit" class="inline-flex cursor-pointer items-center justify-center rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
            Salvar categoria
        </button>
    </div>
</div>
