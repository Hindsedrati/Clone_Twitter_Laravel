<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="h-full text-gray-900 w-full">

            <div class="flex mt-2 mb-4 rounded-md bg-gray-100 relative tabs">
                <button class="dark:bg-gray-900 dark:text-gray-100 focus:outline-none ml-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">List Of User</button>
                <a href="{{ route('admin.list.reports') }}" class="cursor-pointer focus:outline-none mr-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">List Of Reports</a>
                <a href="{{ route('admin.list.words') }}" class="cursor-pointer focus:outline-none mr-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">List Of Words</a>
            </div>



            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <!-- <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <input type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
                    </div>
                </div> -->
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Picture & Banner
                            </th>
                            <!-- <th scope="col" class="px-6 py-3">
                                Banner
                            </th> -->
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Create
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $key => $user)

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img src="{{ asset('storage/profiles/' . $user->picture_path) }}" alt="" class="flex-none h-8 rounded-full w-8" style="object-fit: cover;">
                                    <a href="{{ asset('storage/profiles/' . $user->banner_path) }}" class="ml-4 text-sm font-medium text-blue-500 hover:underline">Voir la banner</a>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-base font-semibold">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-normal text-gray-500">{{'@'}}{{ $user->username }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-normal">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-normal text-gray-500">{{ $user->role_id }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-normal text-gray-500">{{ $user->created_at }}</div>
                                </td>

                                <td class="px-6 py-4 ">
                                    <a href="{{ route('admin.user.edit', $user) }}" class="inline-block w-full px-2 py-1 font-medium transition-colors duration-150 rounded-md hover:text-gray-900 focus:outline-none focus:shadow-outline hover:bg-gray-100" style="inline-size: max-content;">Editer</a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
            
            <div class="pagination flex items-center justify-between">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</main>
