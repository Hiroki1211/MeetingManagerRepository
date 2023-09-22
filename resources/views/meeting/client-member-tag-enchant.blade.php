<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Tag Enchant') }}
        </h2>
    </x-slot>

    <form action="/meeting/client/member/tag/enchant" method="POST">
        @csrf
        @foreach ($tags as $tag)
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
            <input type="hidden" name="tagID[]" value="{{$tag->id}}">
        @endforeach
        <table class="y-scroll simple-table">
            <tr>
                <th></th>
                <th class="simple-th">名前</th>
                <th class="simple-th">なまえ</th>
                <th class="simple-th">タグ</th>
                <th class="simple-th">ID</th>
                <th class="simple-th">e-mail</th>
            </tr>
            @foreach ($clients as $client)
                <tr>
                    <td>
                        <input type="checkbox" name="clientID[]" value="{{$client->id}}">
                    </td>
                    <td class="simple-td">{{ $client-> name_last}} {{ $client-> name_first}}</td>
                    <td class="simple-td">{{ $client-> name_last_read}} {{ $client-> name_first_read}}</td>
                    <td class="simple-td">
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
                        @endforeach</td>
                    <td class="simple-td">{{ $client-> id }}</td>
                    <td class="simple-td">{{ $client-> email}}</td>
                </tr>
            @endforeach
        </table>
        <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">付与</button>
    </form>    

</x-app-layout>