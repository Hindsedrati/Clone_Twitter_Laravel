<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="border-gray-900 h-full text-gray-900 w-full">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow rounded-lg">
                <div class="max-w-xl">
                    <!-- <b>{{ $profile->name }}</b> <span class="text-muted">{{'@'}}{{ $profile->username }}</span> -->
                    <div class="flex items-center justify-between">
                        <img src="{{ asset('storage/profiles/' . $profile->banner_path) }}"
                            class="h-auto max-w-full mb-6 rounded-lg"
                            alt="banner" />
                    </div>
                    <div class="flex">
                        <img src="{{ asset('storage/profiles/' . $profile->picture_path) }}" alt="" class="h-9 flex-none rounded-full">
                        <div class="ml-4 flex-auto">
                            <div class="font-medium">
                                <b>{{ $profile->name }}</b>
                            </div>
                            <div class="mt-1 text-gray-500 text-sm">{{'@'}}{{ $profile->username }}</div>
                        </div>
                    </div>

                    <div class="flex mt-2">
                        <div class="flex">
                            {{ $profile->tweets->count() }} {{ Str::plural('post', $profile->tweets->count()) }}
                        </div>
                        
                        <div class="mr-1 ml-1"> | </div>

                        <div class="flex">
                            {{ $profile->recievedLikes->count() }} {{ Str::plural('like', $profile->recievedLikes->count()) }}
                        </div>

                        <div class="mr-1 ml-1"> | </div>

                        <div class="flex">
                            {{ $profile->followed->count() }} {{ Str::plural('follow', $profile->followed->count()) }}
                        </div>
                    </div>
                </div>
                
                @auth
                
                <div class="max-w-xl text-right">
                    @if(auth()->id() !== $profile->id)
                        <x-divider />
                            @if(in_array(auth()->user()->id, $profile->followed->pluck('followed_user_id')->toArray()))
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

            <div class="flex mt-2 mb-4 rounded-md bg-gray-100 relative tabs">
                <button class="tabs-item w-full relative z-10 py-1 my-2 ml-1 text-center rounded-md text-sm select-none focus:outline-none dark:bg-gray-900 dark:text-gray-100">Your Tweet</button>
                <a href="{{ route('user.profile.followers', $profile) }}" class="tabs-item w-full relative z-10 py-1 my-2 text-center rounded-md text-sm cursor-pointer select-none focus:outline-none">list of followers</a>
                <a href="{{ route('user.profile.followed', $profile) }}" class="tabs-item w-full relative z-10 py-1 my-2 mr-1 text-center rounded-md text-sm cursor-pointer select-none focus:outline-none">list of followed</a>
            </div>

            <div class="max-w-7xl mx-auto">
                @if($tweets->count() === 0)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg ">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <p>No tweets yet.</p>
                        </div>
                    </div>
                @else
                    @foreach($tweets as $key => $tweet)
                        @if ($key > 0) <x-divider /> @endif

                        <x-tweet :tweet="$tweet" />
                    @endforeach
                @endif
            </div>
            
            <div class="mt-6 pagination">
                {{ $tweets->links() }}
            </div>
        </div>
    </div>
</main>
