<?php
    include_once(app_path().'/includes/functions.php');
?>
<x-app-layout>
    <div style="width: 625px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-tweet :tweet="$tweet" />
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-16">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('tweet.retweet', $tweet) }}">
                        @csrf

                        <x-text-input id="tweet" class="block mt-1 w-full" type="text" name="tweet" :value="old('tweet')" required max="5" autocomplete="tweet" />
                        <x-input-error :messages="$errors->get('tweet')" class="mt-2" />

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">tweet</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
