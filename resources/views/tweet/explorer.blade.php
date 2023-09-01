<div class="h-full text-gray-900 w-full">

    <x-tweet-form route="tweet.add" />

    @foreach($tweets as $key => $tweet)
        @if ($key > 0) <x-divider /> @endif

        <x-tweet :tweet="$tweet" />
    @endforeach
    
    <div class="mt-6 pagination">
        {{ $tweets->links() }}
    </div>
</div>
