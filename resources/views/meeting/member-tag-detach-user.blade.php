<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タグ剥奪') }}
        </h2>
    </x-slot>
    
        <form action="/meeting/member/tag/detach/user" method="POST">
            @csrf
            
            <input type="hidden" name="tagID" value="{{$tag->id}}">
            
            <p class="mt-4 ml-4">剥奪するユーザを指定してください</p>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-4 mr-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm whitespace-nowrap px-4 py-2 font-medium text-gray-900">ID</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">名前</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">なまえ</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">タグ</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">e-mail</th>
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
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user-> email}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <p class="notChoose__error" style="color:red">{{ $errors->first('userID') }}</p>

            <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">剥奪</button>
        </form>

</x-app-layout>