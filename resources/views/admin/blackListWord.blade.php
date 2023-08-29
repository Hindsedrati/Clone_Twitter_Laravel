<main class="">
    <div class="flex w-full mx-auto px-6 py-8">
        <div class="h-full text-gray-900 w-full">

            <div class="flex mt-2 mb-4 rounded-md bg-gray-100 relative tabs">
                <a href="{{ route('admin.list.users') }}" class="focus:outline-none ml-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">List Of User</a>
                <a href="{{ route('admin.list.reports') }}" class="cursor-pointer focus:outline-none mr-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">List Of Reports</a>
                <button class="dark:bg-gray-900 dark:text-gray-100 focus:outline-none ml-1 my-2 py-1 relative rounded-md select-none tabs-item text-center text-sm w-full z-10">List Of Words</button>
            </div>



            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="flex justify-end pb-4">
                    <div class="relative">
                        <a href="{{ route('admin.word.add') }}" class="bg-gray-500 duration-150 focus:outline-none focus:shadow-outline font-medium hover:bg-gray-100 hover:text-gray-900 inline-block px-2 py-1 rounded-md transition-colors w-full" style="inline-size: max-content;">Add word</a>
                    </div>
                </div>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-3">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Autor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Word
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($words as $key => $word)

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="h-9 flex-none rounded-full" src="{{ asset('storage/profiles/' . $word->user->picture_path) }}" alt="Jese image">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">{{ $word->user->name }}</div>
                                        <div class="font-normal text-gray-500">{{'@'}}{{ $word->user->username }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $word->word }}
                                </td>
                                <td class="px-6 py-4 ">
                                    <a href="{{ route('admin.word.edit', $word) }}" class="inline-block w-full px-2 py-1 font-medium transition-colors duration-150 rounded-md hover:text-gray-900 focus:outline-none focus:shadow-outline hover:bg-gray-100" style="inline-size: max-content;">Editer</a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>


        </div>
    </div>
</main>
