<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member') }}
        </h2>
    </x-slot>
    
        <div class = "menu">
            <button type="button" onclick="location.href='./member/make'">アカウント発行</button>
            <button type="button" onclick="location.href='./member/tag'">タグ管理</button>
        </div>
        <form action="/meeting/member/delete" method="GET">
            @csrf
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm"class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">ID</th>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">名前</th>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">なまえ</th>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">タグ</th>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">e-mail</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        @foreach ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    <input type="checkbox" name="userID[]" value="{{$user->id}}" class ="h-5 w-5 rounded border-gray-300">
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user-> id }}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user-> name_last}} {{ $user-> name_first}}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user-> name_last_read}} {{ $user-> name_first_read}}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    @foreach($user->tags as $tag)
                                        {{ $tag->name }}
                                    @endforeach
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user-> email}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit">アカウント削除</button>
        </form>

</x-app-layout>