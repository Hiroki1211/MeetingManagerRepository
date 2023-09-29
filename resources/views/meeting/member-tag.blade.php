<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タグ管理') }}
        </h2>
    </x-slot>

        <div class = "menu mt-4 ml-4">
            <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="button" onClick="location.href='./tag/make'">タグ作成</button>
        </div>
        <form method = "GET" action = "?">
            @csrf
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-4 mr-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm"> </th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">名前</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">色</th>
                        </tr>
                    </thread>
                    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        @foreach ($tags as $tag)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    <input type="checkbox" name = "tagID[]" value = "{{ $tag->id }}" class ="h-5 w-5 rounded border-gray-300">
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $tag->id }}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $tag->name }}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $tag->color }}</td>
                            </tr>
                        @endforeach
                </table>
            </div>
            <div class = "menu mt-4 ml-4">
                <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type = "submit" value = "enchant" formaction = "/meeting/member/tag/enchant">タグ付与</button>
                <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type = "submit" value = "delete" formaction = "/meeting/member/tag/delete">タグ削除</button>
            </div>
        </form>
        
        <br/>
        <dev class ="mt-4 ml-4 footer bg-gray-100 text-gray-800 text-1xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
            <a href = "/meeting/member">戻る</a>
        </dev>

</x-app-layout>
