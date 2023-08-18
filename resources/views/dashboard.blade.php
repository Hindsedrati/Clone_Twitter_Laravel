<?php
    include_once(app_path().'/includes/functions.php');
?>
<x-app-layout>
    @if(!Auth::id())
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            <a href="{{ route('user.login') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login</a>
            <a href="{{ route('user.register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
        </div>
    @endif

    <div class="max-w-7xl mx-auto p-6 lg:p-8" style="width: 625px;">
        @if(Auth::id())
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('tweet.add') }}">
                        @csrf

                        <x-text-input id="tweet" class="block mt-1 w-full" type="emtextail" name="tweet" :value="old('tweet')" required max="5" autocomplete="tweet" />
                        <x-input-error :messages="$errors->get('tweet')" class="mt-2" />

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                tweet
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="separator" style="border: 1px solid rgb(214, 220, 234); margin-bottom: 10px; margin-top: 10px; width: 100%;"></div>
        @endif

        @foreach($tweets as $key => $tweet)
            @if ($key > 0) <div class="separator" style="border: 1px solid rgb(214, 220, 234); margin-bottom: 10px; margin-top: 10px; width: 100%;"></div> @endif

            <x-tweet :tweet="$tweet" />
        @endforeach
    </div>

    {{ $tweets->links() }}
</x-app-layout>
