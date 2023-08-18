<x-guest-layout>
    <form method="POST" action="{{ route('user.register') }}" class="mx-auto max-w-xl">
        @csrf

        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
            <!-- Username -->
            <div class="">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-300">Username</label>
                <div class="mt-2">
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required max="60" autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>
            </div>
            <!-- Name -->
            <div class="">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-300">Name</label>
                <div class="mt-2">
                    <div class="block border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300 flex focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-inset focus:border-indigo-500 focus:ring-indigo-500 ring-1 ring-gray-600 ring-inset rounded-md shadow-sm sm:max-w-md w-full">
                        <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">@</span>
                        <input type="text" name="name" id="name" autocomplete="name" class="bg-transparent block border-0 flex-1 focus:ring-0 pl-1 placeholder:text-gray-400 py-1.5 sm:leading-6 sm:text-sm text-gray-300">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required max="255" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required min="6"
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-300 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('user.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
