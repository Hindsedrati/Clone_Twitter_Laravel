<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('unBan Account') }}
        </h2>
    </header>

    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('unBan Account') }}</x-primary-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('admin.user.unban', $user) }}" class="p-6">
            @csrf
            @method('patch')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Etes-vous sûr de vouloir débannir cet utilisateur ?') }}
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('unBan Account') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
