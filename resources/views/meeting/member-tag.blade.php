<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タグ管理') }}
        </h2>
    </x-slot>

        <div class = "menu">
            <button type="button" onClick="location.href='./tag/make'">タグ作成</button>
        </div>
        <form method = "GET" action = "?">
            @csrf
            <table class="y-scroll simple-table">
                <tr>
                    <th class="simple-th"> </th>
                    <th class="simple-th">ID</th>
                    <th class="simple-th">名前</th>
                    <th class="simple-th">色</th>
                </tr>
                @foreach ($tags as $tag)
                    <tr>
                        <td class="simple-td">
                            <input type="checkbox" name = "tagID[]" value = "{{ $tag->id }}">
                        </td>
                        <td class="simple-td">{{ $tag->id }}</td>
                        <td class="simple-td">{{ $tag->name }}</td>
                        <td class="simple-td">{{ $tag->color }}</td>
                    </tr>
                @endforeach
            </table>
            <div class = "menu">
                <button type = "submit" value = "enchant" formaction = "/meeting/member/tag/enchant">タグ付与</button>
                <button type = "submit" value = "delete" formaction = "/meeting/member/tag/delete">タグ削除</button>
            </div>
        </form>
        
        <br/>
        <dev class ="footer">
            <a href = "/meeting/member">戻る</a>
        </dev>

</x-app-layout>
