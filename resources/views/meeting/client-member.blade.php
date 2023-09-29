<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client') }}
        </h2>
    </x-slot>
    
        <div class = "menu mt-4 ml-4">
            <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="button" onclick="location.href='member/make'">アカウント発行</button>
            <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="button" onclick="location.href='./member/tag'">タグ管理</button>
        </div>
        <form action="/meeting/client/member/delete" method="GET">
            @csrf
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-4 mr-4">
                <table class=" w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm"class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">ID</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">名前</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">なまえ</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">タグ</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">e-mail</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        @foreach ($clients as $client)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    <input type="checkbox" name="clientID[]" value="{{$client->id}}" class ="h-5 w-5 rounded border-gray-300">
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $client-> id }}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $client-> name_last}} {{ $client-> name_first}}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $client-> name_last_read}} {{ $client-> name_first_read}}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    @foreach($client->tags as $tag)
                                        <?php
                                            if($tag->color == "red"){
                                        ?>
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                                                {{ $tag->name }}
                                            </span>
                                        <?php
                                            }else if($tag->color == "green"){
                                        ?>
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">
                                                {{ $tag->name }}
                                            </span>
                                        <?php
                                            }else if($tag->color == "blue"){
                                        ?>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                                {{ $tag->name }}
                                            </span>
                                        <?php
                                            }
                                        ?>
                                    @endforeach
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $client-> email}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">アカウント削除</button>
        </form>

</x-app-layout>