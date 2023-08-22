<nav class="mx-auto">
    <div class="bg-white dark:bg-gray-800 px-6 rounded-lg" style="position: -webkit-sticky; position: sticky; top: 90px;">

        <h1 class="p-4 text-center text-indigo-600 text-xl">Tendances</h1>

        <x-divider />

        <div class="border-gray-900 flex h-full pb-3 text-gray-400 text-xl w-full">
            <div class="">
                @foreach($rightbar["hashtags"] as $hashtag)
                    <div class="flex">
                        <a href="{{ route('tweet.explorer', $hashtag['hashtag']) }}" class='text-indigo-600 ml-1' style="text-transform: capitalize;">#{{ $hashtag["hashtag"] }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</nav>
