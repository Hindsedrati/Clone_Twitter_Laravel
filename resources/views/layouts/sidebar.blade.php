<nav class="mx-auto">
    <div class="bg-white dark:bg-gray-800 px-6 rounded-lg" style="position: -webkit-sticky; position: sticky; top: 90px;">
        <div class="flex flex-col h-full items-center pb-3 text-xl w-full">
            @auth
                <img src="{{ asset('storage/profiles/' . auth()->user()->picture_path) }}" alt="" class="flex-none h-8 rounded-full w-8 mt-4" style="object-fit: cover;">
            @endauth

            <a href="{{ route('tweet.dashboard') }}" class="hover:bg-gray-700 mt-2 p-2 rounded-lg text-center text-left text-sm text-white w-full">Home</a>
            <a href="{{ route('tweet.followed') }}" class="hover:bg-gray-700 p-2 rounded-lg text-center text-left text-sm text-white w-full">Follow</a>

            @auth
                <x-divider />

                <a href="{{ route('user.profile', auth()->user()->username ) }}" class="hover:bg-gray-700 p-2 rounded-lg text-center text-left text-sm text-white w-full">My Profile</a>
                <a href="{{ route('profile.edit') }}" class="hover:bg-gray-700 p-2 rounded-lg text-center text-left text-sm text-white w-full">Setting</a>

                @if(auth()->user()->role_id == 3)
                    <x-divider />

                    <a href="{{ route('admin.dashboard') }}" class="hover:bg-gray-700 p-2 rounded-lg text-center text-left text-sm text-white w-full">Admin</a>
                @endif

                <x-divider />

                <a href="{{ route('logout') }}" class="hover:bg-red-500 p-2 rounded-lg text-center text-left text-sm text-white w-full">Logout</a>
            @endauth
        </div>
    </div>
</nav>