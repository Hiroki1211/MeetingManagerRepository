<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client 削除') }}
        </h2>
    </x-slot>
    
    
        以下を削除しますか？
        <form action= "/meeting/client/member/delete" method="POST">
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
            @foreach ($clients as $client)
                <tr>
                    <td class="simple-td">
                        {{ $client-> id }}<input type="hidden" name="clientID[]" value="{{ $client->id }}">
                    </td>
                    <td class="simple-td">{{ $client-> name_last}} {{ $client-> name_last}}</td>
                    <td class="simple-td">{{ $client-> name_last_read}} {{ $client-> name_first_read}}</td>
                    <td class="simple-td">

                    <td class="simple-td">{{ $client-> email}}</td>
                </tr>
            @endforeach
            </table>
            
            <button type="submit">削除</button>
        </form>

</x-app-layout>