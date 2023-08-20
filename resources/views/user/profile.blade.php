<?php
    include_once(app_path().'/includes/functions.php');
?>
<x-app-layout>
    <div style="width: 625px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <b>{{ $profile->username }}</b> <span class="text-muted">{{'@'}}{{ $profile->name }}</span>

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
                    <div class="separator" style="border: 1px solid rgb(214, 220, 234); margin-bottom: 10px; margin-top: 10px; width: 100%;"></div>
                    
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


            <div class="lg:px-8 max-w-7xl mt-16 mx-auto">
                @foreach($tweets as $key => $tweet)
                    @if ($key > 0) <div class="separator" style="border: 1px solid rgb(214, 220, 234);
                        margin-bottom: 10px;
                        margin-top: 10px;
                        width: 100%;"></div>
                    @endif

                    <x-tweet :tweet="$tweet" />
                @endforeach
            </div>

            {{ $tweets->links() }}
        </div>
    </div>
</x-app-layout>
