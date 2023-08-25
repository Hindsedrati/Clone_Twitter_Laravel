<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="

            <x-tweet-form route="tweet.add" />

            <div class="flex mt-2 mb-4 rounded-md bg-gray-100 relative tabs">
                <button class="tabs-item w-full relative z-10 py-1 my-2 ml-2 text-center rounded-md text-sm select-none focus:outline-none dark:bg-gray-900 dark:text-gray-100">For You</button>
                <a href="{{ route('tweet.followed') }}" class="tabs-item w-full relative z-10 py-1 my-2 ml-2 text-center rounded-md text-sm cursor-pointer select-none focus:outline-none">Followed</a>
            </div>

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
