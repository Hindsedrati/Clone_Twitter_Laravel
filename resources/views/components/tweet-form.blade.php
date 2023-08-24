@if(Auth::id())
    <div class="dark:bg-gray-800 overflow-hidden rounded-lg shadow-sm">
        @if (isset($tweet))
            <form method="POST" action="{{ route($route, $tweet) }}">
        @else
            <form method="POST" action="{{ route($route) }}">
        @endif
            @csrf

            <div class="dark:bg-gray-700 rounded-lg w-full">
                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea id="tweet" name="tweet" :value="old('tweet')" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>

                    <x-input-error :messages="$errors->get('tweet')" class="mt-2" />
                </div>
                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                    <button type="submit" class="font-medium items-center px-4 py-2 rounded-lg text-center hover:bg-gray-800 text-white text-xs">
                        TWEET
                    </button>
                    <div class="flex pl-0 space-x-1 sm:pl-2">
                        <button type="button" class="font-medium hover:bg-gray-100 hover:text-gray-700 items-center px-4 py-2 rounded-lg text-center text-white text-xs">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                </svg>
                            <span class="sr-only">Upload image</span>
                        </button>
                    </div>
                </div>
                <div>
                    <input type="file" name="files[]" class="filepond" data-max-file-size="3MB" multiple/>
                </div>
            </div>
        </form>
    </div>

    <x-divider />
@endif