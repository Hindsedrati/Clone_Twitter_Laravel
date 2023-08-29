<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Black List Word') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add Black List Word') }}
        </p>
    </header>

    <form method="POST" action="{{ route('admin.word.add') }}">
        @csrf

        <div>
            <x-input-label for="word" :value="__('Word')" />

            <input id="word" name="word" type="text" class="mt-1 block w-full" :value="old('word')" required autofocus autocomplete="word" />

            <x-input-error class="mt-2" :messages="$errors->get('word')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('ADD') }}
            </x-primary-button>
        </div>
    </form>
</section>
