<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="h-full text-gray-900 w-full">

            <x-tweet-form route="tweet.retweet" :tweet="$tweet" />

            <x-tweet :tweet="$tweet" />
        </div>
    </div>
</main>
