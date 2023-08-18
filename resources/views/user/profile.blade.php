<?php
    include_once(app_path().'/includes/functions.php');
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div style="width: 625px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{ $profile->username }}
                </div>
            </div>
        </div>


        <div class="lg:px-8 max-w-7xl mt-16 mx-auto">
            @foreach($tweets as $key => $tweet)
                @if ($key > 0) <div class="separator" style="border: 1px solid rgb(214, 220, 234);
                    margin-bottom: 10px;
                    margin-top: 10px;
                    width: 100%;"></div>
                @endif

                <x-tweet :tweet="$tweet" />
            @endforeach
        </div>
    </div>

    {{ $tweets->links() }}
</x-app-layout>
