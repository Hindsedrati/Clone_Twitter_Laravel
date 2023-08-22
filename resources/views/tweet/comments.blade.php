<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="border-4 border-dashed border-gray-900 h-full text-gray-900 w-full">

            <div class="mx-auto space-y-6">
                <x-tweet :tweet="$tweet" />
            </div>

            <x-divider />

            @if(Auth::id())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form method="POST" action="{{ route('tweet.addComment', $tweet) }}">
                            @csrf

                            <x-text-input id="tweet" class="block mt-1 w-full" type="text" name="tweet" :value="old('tweet')" required max="5" autocomplete="tweet" />
                            <x-input-error :messages="$errors->get('tweet')" class="mt-2" />

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">tweet</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>

                <x-divider />
            @endif

            @if(isset($comments) && count($comments) > 0)
                @foreach($comments as $key => $tweet)
                    @if ($key > 0) <x-divider /> @endif

                    <x-tweet :tweet="$tweet" />
                @endforeach

                <div class="mt-6 pagination">
                    {{ $comments->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg ">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p>No comments yet.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
