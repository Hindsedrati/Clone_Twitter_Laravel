<header class="fixed p-4 top-0">
    <div class="flex">
        <a href="{{ route('tweet.dashboard') }}" class="text-2xl font-bold text-gray-800 dark:text-white lg:text-3xl hover:text-gray-700 dark:hover:text-gray-300">Twitter</a>
    </div>
    <div class="flex">
        @if(!Auth::id())
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                <a href="{{ route('user.login') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login</a>
                <a href="{{ route('user.register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            </div>
        @endif
    </div>
</header>