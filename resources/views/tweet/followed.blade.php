<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="h-full text-gray-900 w-full">

            <x-tweet-form route="tweet.add" />

            <div class="flex mt-2 mb-4 rounded-md bg-gray-100 relative tabs">
                <a href="{{ route('tweet.dashboard') }}" class="tabs-item w-full relative z-10 py-1 my-2 ml-2 text-center rounded-md text-sm select-none focus:outline-none">For You</a>
                <button class="tabs-item w-full relative z-10 py-1 my-2 ml-2 text-center rounded-md text-sm cursor-pointer select-none focus:outline-none dark:bg-gray-900 dark:text-gray-100">Followed</button>
                <!-- <span class="tab-item-animate rounded-md bg-white active"></span> -->
            </div>

            @if ($tweets->count() === 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg ">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p>No followed tweets yet.</p>
                    </div>
                </div>
            @else
                @foreach($tweets as $key => $tweet)
                    @if ($key > 0) <x-divider /> @endif

                    <x-tweet :tweet="$tweet" />
                @endforeach
            @endif
            
            <div class="mt-6 pagination">
                {{ $tweets->links() }}
            </div>
        </div>
    </div>
</main>
