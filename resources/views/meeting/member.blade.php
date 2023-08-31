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
            <table class="y-scroll simple-table">
                <tr>
                    <th class="simple-th"></th>
                    <th class="simple-th">ID</th>
                    <th class="simple-th">名前</th>
                    <th class="simple-th">なまえ</th>
                    <th class="simple-th">タグ</th>
                    <th class="simple-th">e-mail</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td class="simple-td">
                            <input type="checkbox" name="userID[]" value="{{$user->id}}">
                        </td>
                        <td class="simple-td">{{ $user-> id }}</td>
                        <td class="simple-td">{{ $user-> name_last}} {{ $user-> name_first}}</td>
                        <td class="simple-td">{{ $user-> name_last_read}} {{ $user-> name_first_read}}</td>
                        <td class="simple-td">
                            @foreach($user->tags as $tag)
                                {{ $tag->name }}
                            @endforeach
                        </td>
                        <td class="simple-td">{{ $user-> email}}</td>
                    </tr>
                @endforeach
            </table>
            <button type="submit">アカウント削除</button>
        </form>

</x-app-layout>