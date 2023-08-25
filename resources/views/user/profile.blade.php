<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="border-gray-900 h-full text-gray-900 w-full">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow rounded-lg">
                <div class="max-w-xl">
                    <!-- <b>{{ $profile->username }}</b> <span class="text-muted">{{'@'}}{{ $profile->name }}</span> -->
                    <div class="flex items-center justify-between">
                        <img src="{{ asset('storage/profiles/' . $profile->banner_path) }}"
                            class="h-auto max-w-full mb-6 rounded-lg"
                            alt="banner" />
                    </div>
                    <div class="flex">
                        <img src="{{ asset('storage/profiles/' . $profile->picture_path) }}" alt="" class="h-9 flex-none rounded-full">
                        <div class="ml-4 flex-auto">
                            <div class="font-medium">
                                <b>{{ $profile->username }}</b>
                            </div>
                            <div class="mt-1 text-gray-500 text-sm">{{'@'}}{{ $profile->name }}</div>
                        </div>
                    </div>

                    <div class="flex mt-2">
                        <div class="flex">
                            {{ $tweets->count() }} {{ Str::plural('post', $tweets->count()) }}
                        </div>
                        
                        <div class="mr-1 ml-1"> | </div>

                        <div class="flex">
                            {{ $profile->recievedLikes->count() }} {{ Str::plural('like', $profile->recievedLikes->count()) }}
                        </div>

                        <div class="mr-1 ml-1"> | </div>

                        <div class="flex">
                            {{ $profile->followers->count() }} {{ Str::plural('follow', $profile->followers->count()) }}
                        </div>
                    </div>
                </div>
                
                @auth
                    <x-divider />
                    
                    <div class="max-w-xl text-right">
                        @if (auth()->id() !== $profile->id)
                            @if($profile->followers->count())
                                <form method="POST" action="{{ route('user.follow', $profile) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button class="">
                                        Unfollow
                                    </x-primary-button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('user.follow', $profile) }}">
                                    @csrf
                                    <x-primary-button class="">
                                        Follow
                                    </x-primary-button>
                                </form>
                            @endif
                        @endif
                    </div>
                @endauth
            </div>

            <div class="max-w-7xl mt-16 mx-auto">
                @foreach($tweets as $key => $tweet)
                    @if ($key > 0) <x-divider /> @endif

                    <x-tweet :tweet="$tweet" />
                @endforeach
            </div>
            
            <div class="mt-6 pagination">
                {{ $tweets->links() }}
            </div>
        </div>
    </div>
</main>
