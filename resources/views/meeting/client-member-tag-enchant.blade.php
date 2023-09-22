<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Tag Enchant') }}
        </h2>
    </x-slot>

    <form action="/meeting/client/member/tag/enchant" method="POST">
        @csrf
        @foreach ($tags as $tag)
            <p>{{$tag->name}}</p>
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
                            {{ $tag->name }}
                        @endforeach</td>
                    <td class="simple-td">{{ $client-> id }}</td>
                    <td class="simple-td">{{ $client-> email}}</td>
                </tr>
            @endforeach
        </table>
        <button type="submit">付与</button>
    </form>    

</x-app-layout>