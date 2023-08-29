<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Reset Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Envoyer un lien de réinitialisation de mot de passe par e-mail') }}
        </p>
    </header>

    <form method="POST" action="{{ route('admin.user.link.password', $user) }}">
        @csrf

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</section>
