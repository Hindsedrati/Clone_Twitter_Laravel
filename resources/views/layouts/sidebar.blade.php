<nav class="mx-auto">
    <div class="bg-white dark:bg-gray-800 px-6 rounded-lg" style="position: -webkit-sticky; position: sticky; top: 90px;">
        <div class="flex flex-col h-full items-center pb-3 text-xl w-full">
            @auth
                <img src="{{ asset('storage/profiles/' . auth()->user()->picture_path) }}" alt="" class="flex-none h-8 mt-4 rounded-full w-8">
            @endauth

            <a href="{{ route('tweet.dashboard') }}" class="p-2 mt-1 text-left text-white text-sm">Home</a>
            <a href="{{ route('tweet.followed') }}" class="p-2 text-left text-white text-sm">Follow</a>

            @auth
                <x-divider />
                
                <a href="{{ route('user.profile', auth()->user()->name ) }}" class="p-2 text-left text-white text-sm">My Profile</a>
                <a href="{{ route('profile.edit') }}" class="p-2 text-left text-white text-sm">Setting</a>

                @if(auth()->user()->role_id == 3)
                    <x-divider />

                    <a href="" class="p-2 text-left text-white text-sm">Admin</a>
                @endif

                <x-divider />

                <a href="{{ route('logout') }}" class="p-2 text-left text-white text-sm">Logout</a>
            @endauth
        </div>
    </div>
</nav>