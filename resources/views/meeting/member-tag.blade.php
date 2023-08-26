<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タグ管理') }}
        </h2>
    </x-slot>

        <div class = "menu">
            <button type="button" onClick="location.href='./tag/make'">タグ作成</button>
            <button type="button">タグ削除</button>
        </div>
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
                        <input type="checkbox">
                    </td>
                    <td class="simple-td">{{ $tag->id }}</td>
                    <td class="simple-td">{{ $tag->name }}</td>
                    <td class="simple-td">{{ $tag->color }}</td>
                </tr>
            @endforeach
        </table>
        <button type = "submit" value = "enchant">タグ付与</button>
        <br/>
        <dev class ="footer">
            <a href = "/meeting/member">戻る</a>
        </dev>

</x-app-layout>
