<main class="">
    <div class="flex py-8 w-full">
        <div class="h-full text-gray-900 w-full">

            <div class="flex mt-2 mb-4 rounded-md bg-gray-100 relative tabs">
                <a href="{{ route('admin.list.users') }}" class="focus:outline-none ml-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">List Of User</a>
                <button class="dark:bg-gray-900 dark:text-gray-100 cursor-pointer focus:outline-none mr-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">List Of Reports</button>
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
                                Autor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tweet
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($reports as $key => $report)

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="h-9 flex-none rounded-full" src="{{ asset('storage/profiles/' . $report->tweet->user->picture_path) }}" alt="Jese image">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">{{ $report->tweet->user->name }}</div>
                                        <div class="font-normal text-gray-500">{{'@'}}{{ $report->tweet->user->username }}</div>
                                    </div>  
                                </th>
                                <td class="px-6 py-4">
                                    {{ $report->tweet->tweet }}
                                </td>
                                <td class="px-6 py-4 ">
                                    <form action="{{ route('admin.report.check', $report->id) }}" method="post">
                                        @csrf
                                        <input type="submit" value="Valide" class="inline-block w-full px-2 py-1 font-medium transition-colors duration-150 rounded-md hover:text-gray-900 focus:outline-none focus:shadow-outline hover:bg-gray-100" style="inline-size: max-content;"></input>
                                    </form>
                                    <form action="{{ route('admin.report.delete', $report->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="inline-block w-full px-2 py-1 font-medium transition-colors duration-150 rounded-md hover:text-gray-900 focus:outline-none focus:shadow-outline hover:bg-gray-100" style="inline-size: max-content;"></input>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>


        </div>
    </div>
</main>
