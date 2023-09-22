<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member 削除') }}
        </h2>
    </x-slot>
    
    
        以下を削除しますか？
        <form action= "/meeting/member/delete" method="POST">
            @csrf
            @method('DELETE')
            <table class="y-scroll simple-table">
            <tr>
                <th class="simple-th">ID</th>
                <th class="simple-th">名前</th>
                <th class="simple-th">なまえ</th>
                <th class="simple-th">タグ</th>
                <th class="simple-th">e-mail</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td class="simple-td">
                        {{ $user-> id }}<input type="hidden" name="userID[]" value="{{ $user->id }}">
                    </td>
                    <td class="simple-td">{{ $user-> name_last}} {{ $user-> name_last}}</td>
                    <td class="simple-td">{{ $user-> name_last_read}} {{ $user-> name_first_read}}</td>
                    <td class="simple-td">
                        @foreach($user->tags as $tag)
                            {{ $tag->name }}
                        @endforeach</td>
                    <td class="simple-td">{{ $user-> email}}</td>
                </tr>
            @endforeach
            </table>
            
            <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">削除</button>
        </form>

</x-app-layout>