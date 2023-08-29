@props(['tweet' => $tweet])

<div class="dark:bg-gray-800 sm:rounded-lg">
    <div class="dark:text-gray-100 p-6 text-gray-900">
        <div class="flex justify-between relative">
            <!-- <div class="">
                <a href="{{ route('user.profile', $tweet->user->username) }}"><b>{{ $tweet->user->name }}</b></a> <span class="ml-1 mr-1 text-gray-500 text-muted text-sm">{{'@'}}{{ $tweet->user->name }}</span> - <span class="ml-1"><?= convertTimeToString($tweet->created_at); ?></span>
            </div> -->
            <div class="flex">
                <img src="{{ asset('storage/profiles/' . $tweet->user->picture_path) }}" alt="" class="h-9 flex-none rounded-full">
                <div class="ml-4 flex-auto">
                    <div class="font-medium">
                        <a href="{{ route('user.profile', $tweet->user->username) }}"><b>{{ $tweet->user->name }}</b></a>  - <span class="ml-1"><?= convertTimeToString($tweet->created_at); ?></span>
                    </div>
                    <div class="mt-1 text-gray-500 text-sm">{{'@'}}{{ $tweet->user->username }}</div>
                </div>
            </div>

            @auth
                <!-- DropDown -->
                <button class="absolute dropdown:block px-2 py-1 right-0 rounded-md text-xs top-0" style="--tw-ring-color: #270000; --tw-ring-inset: inset; --tw-text-opacity: 1; color: rgb(185 28 28 / var(--tw-text-opacity)); --tw-bg-opacity: 1; background-color: #270000;" role="navigation" aria-haspopup="true">
                    <div class="flex items-center">
                        <span class="px-2 text-gray-700">...</span>
                    </div>
                    <ul class="absolute left-0 hidden w-auto p-2 mt-3 space-y-2 text-sm bg-white border border-gray-100 rounded-lg shadow-lg" aria-label="submenu">

                        <form action="{{ route('tweet.report', $tweet) }}" method="post">
                            @csrf
                            <input type="submit" value="Signaler" class="inline-block w-full px-2 py-1 font-medium text-gray-600 transition-colors duration-150 rounded-md hover:text-gray-900 focus:outline-none focus:shadow-outline hover:bg-gray-100" style="inline-size: max-content;"></input>
                        </form>
                        
                        @if(auth()->user()->id == $tweet->user_id)
                            <x-divider />

                            <form action="{{ route('tweet.delete', $tweet->uuid) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="inline-block w-full px-2 py-1 font-medium text-gray-600 transition-colors duration-150 rounded-md hover:text-gray-900 focus:outline-none focus:shadow-outline hover:bg-gray-100" style="inline-size: max-content;"></input>
                            </form>
                        @endif

                        <!-- @if($tweet->comment)
                            @if(auth()->user()->id == $tweet->comment->user_id)
                                <form action="{{ route('tweet.delete', $tweet->uuid) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Masquer" class="inline-block w-full px-2 py-1 font-medium text-gray-600 transition-colors duration-150 rounded-md hover:text-gray-900 focus:outline-none focus:shadow-outline hover:bg-gray-100" style="inline-size: max-content;"></input>
                                </form>
                            @endif
                        @endif -->

                        @if(in_array(auth()->user()->role_id, [2,3]))
                            <form action="{{ route('modo.tweet.delete', $tweet->uuid) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete (Modo)" class="inline-block w-full px-2 py-1 font-medium text-gray-600 transition-colors duration-150 rounded-md hover:text-gray-900 focus:outline-none focus:shadow-outline hover:bg-gray-100" style="inline-size: max-content;"></input>
                            </form>
                        @endif

                    </ul>
                </button>
            @endauth
        </div>

        @if ($tweet->trashed())
            <div class="flex mb-4 mt-2">Ce tweet a été masqué.</div>
        @else
            <div class="flex mb-4 mt-2">{!! $tweet->tweet !!}</div>
        @endif

        @if($tweet->files)
            <div class="flex mx-6">
                @foreach($tweet->files as $file)
                    <img src="{{ asset('storage/uploads/' . $file->path) }}" alt="image" class="mb-4">
                @endforeach
            </div>
        @endif

        @if($tweet->retweet)
            <x-divider />
            
            <div class="flex items-center">
                <a href="{{ route('user.profile', $tweet->retweet->user->name) }}"><b>{{ $tweet->retweet->user->username }}</b></a> <span class="ml-1 mr-1 text-gray-500 text-muted text-sm">{{'@'}}{{ $tweet->retweet->user->name }}</span> - <span class="ml-1"><?= convertTimeToString($tweet->retweet->created_at); ?></span>
            </div>

            <div class="flex mb-4 mt-2">{!! \App\Http\Controllers\Controller::hashtag_links($tweet->retweet->tweet) !!}</div>

            <a href="{{ route('tweet.comments', $tweet->retweet->uuid) }}" class="text-indigo-600 text-sm">https://{{request()->getHttpHost()}}/tweet/{{$tweet->retweet->uuid}}</a>
        @endif

        <div class="flex items-center">
            <div class="flex"> <!-- commentaires -->
                <a class="flex" href="{{ route('tweet.comments', $tweet->uuid) }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1">
                        <path fill="currentColor" d="M9 12C9 12.5523 8.55228 13 8 13C7.44772 13 7 12.5523 7 12C7 11.4477 7.44772 11 8 11C8.55228 11 9 11.4477 9 12Z"/>
                        <path fill="currentColor" d="M13 12C13 12.5523 12.5523 13 12 13C11.4477 13 11 12.5523 11 12C11 11.4477 11.4477 11 12 11C12.5523 11 13 11.4477 13 12Z"/>
                        <path fill="currentColor" d="M17 12C17 12.5523 16.5523 13 16 13C15.4477 13 15 12.5523 15 12C15 11.4477 15.4477 11 16 11C16.5523 11 17 11.4477 17 12Z"/>
                        <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"/>
                    </svg>
                    <span>commentaires</span>
                </a>
            </div>

            <div class="mr-1 ml-1"> | </div>

            <div class="flex"> <!-- retweet -->
                <a class="flex" href="{{ route('tweet.retweet', $tweet->uuid) }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1">
                        <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M19.5 12L14.5 17M19.5 12L14.5 7M19.5 12L13 12M9.5 12C7.83333 12 4.5 11 4.5 7"/>
                    </svg>
                    <span>Retweet</span>
                </a>
            </div>

            <div class="mr-1 ml-1"> | </div>

            <div class="flex"> <!-- like -->
                @auth
                    @if (!$tweet->likedBy(auth()->user()))
                        <form action="{{ route('tweet.likes', $tweet) }}" method="post" class="mr-1 flex justify-between items-center">
                            @csrf
                            <button type="submit" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.4" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" fill="none" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('tweet.likes', $tweet) }}" method="post" class="mr-1 flex justify-between items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.4" stroke="red" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </form>
                    @endif
                @endauth

                <span>
                    @if($tweet->likes)
                        {{ $tweet->likes->count() }} {{ Str::plural('like', $tweet->likes->count()) }}
                    @else
                        0 like
                    @endif
                </span>
            </div>

            <div class="mr-1 ml-1"> | </div>

            <div class="flex"> <!-- analytics -->
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1">
                    <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M3 22H21"/>
                    <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" d="M3 17C3 17.9428 3 18.4142 3.29289 18.7071C3.58579 19 4.05719 19 5 19C5.94281 19 6.41421 19 6.70711 18.7071C7 18.4142 7 17.9428 7 17V11C7 10.0572 7 9.58579 6.70711 9.29289C6.41421 9 5.94281 9 5 9C4.05719 9 3.58579 9 3.29289 9.29289C3 9.58579 3 10.0572 3 11V13"/>
                    <path stroke="currentColor" stroke-width="1.5" d="M10 7C10 6.05719 10 5.58579 10.2929 5.29289C10.5858 5 11.0572 5 12 5C12.9428 5 13.4142 5 13.7071 5.29289C14 5.58579 14 6.05719 14 7V17C14 17.9428 14 18.4142 13.7071 18.7071C13.4142 19 12.9428 19 12 19C11.0572 19 10.5858 19 10.2929 18.7071C10 18.4142 10 17.9428 10 17V7Z"/>
                    <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" d="M21 11V17C21 17.9428 21 18.4142 20.7071 18.7071C20.4142 19 19.9428 19 19 19C18.0572 19 17.5858 19 17.2929 18.7071C17 18.4142 17 17.9428 17 17V4C17 3.05719 17 2.58579 17.2929 2.29289C17.5858 2 18.0572 2 19 2C19.9428 2 20.4142 2 20.7071 2.29289C21 2.58579 21 3.05719 21 4V7"/>
                </svg>
                <span>{{ $tweet->analytics->count() }}</span>
            </div>
        </div>
    </div>
</div>