<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Bannierre de profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mettez à jour la bannierre de votre compte.") }}
        </p>

        <div class="-space-x-2 flex justify-center mt-6 overflow-hidden">
            <img src="{{ asset('storage/profiles/' . $user->banner_path) }}" alt="" class="flex-none h-8 rounded-full w-8" style="object-fit: cover;">
        </div>
    </header>

    <form method="post" action="{{ route('profile.update.banner') }}" class="mt-6 space-y-6">
        @csrf
        
        <input type="file" name="profile_banner" class="filepond--banner mb-0" data-max-file-size="3MB" required />

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
