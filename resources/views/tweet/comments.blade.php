<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="border-4 border-dashed border-gray-900 h-full text-gray-900 w-full">

            <div class="mx-auto space-y-6">
                <x-tweet :tweet="$tweet" />
            </div>

            <x-divider />

            <x-tweet-form route="tweet.addComment" :tweet="$tweet" />

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
