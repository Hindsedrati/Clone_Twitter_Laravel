<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="h-full text-gray-900 w-full">

            <x-tweet-form route="tweet.add" />

            <div class="flex mt-2 mb-4 rounded-md bg-gray-100 relative tabs">
                <button class="dark:bg-gray-900 dark:text-gray-100 focus:outline-none ml-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">For You</button>
                <a href="{{ route('tweet.followed') }}" class="cursor-pointer focus:outline-none mr-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">Followed</a>
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
