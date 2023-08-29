<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update role') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update user role') }}
        </p>
    </header>

    <form method="POST" action="{{ route('admin.user.role', $user) }}">
        @csrf

        <!-- Role -->
        <div>
            <x-input-label for="role" :value="__('Role')" />

            <select id="role" name="role_id" class="block mt-1 w-full">
                <option value="user" {{ $user->role_id == '1' ? 'selected' : '' }}>User</option>
                <option value="modo" {{ $user->role_id == '2' ? 'selected' : '' }}>Modo</option>
                <option value="admin" {{ $user->role_id == '3' ? 'selected' : '' }}>Admin</option>
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('SAVE') }}
            </x-primary-button>
        </div>
    </form>
</section>
