<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="border-4 border-dashed border-gray-900 h-full text-gray-900 w-full">

            <x-tweet-form route="tweet.add" />

            @foreach($tweets as $key => $tweet)
                @if ($key > 0) <x-divider /> @endif

                <x-tweet :tweet="$tweet" />
            @endforeach
            
            <div class="mt-6 pagination">
                {{ $tweets->links() }}
            </div>
        </div>
    </div>
</main>
