<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member Tag Enchant') }}
        </h2>
    </x-slot>
    
    @foreach ($tags as $tag)
    <p>{{$tag->name}}</p>
    @endforeach

    <form action="/meeting/member/tag/enchant" method="POST">
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
            @foreach ($users as $user)
                <tr>
                    <td>
                        <input type="checkbox" name="userID[]" value="{{$user->id}}">
                    </td>
                    <td class="simple-td">{{ $user-> name_last}} {{ $user-> name_first}}</td>
                    <td class="simple-td">{{ $user-> name_last_read}} {{ $user-> name_first_read}}</td>
                    <td class="simple-td">
                        @foreach($user->tags as $tag)
                            {{ $tag->name }}
                        @endforeach</td>
                    <td class="simple-td">{{ $user-> id }}</td>
                    <td class="simple-td">{{ $user-> email}}</td>
                </tr>
            @endforeach
        </table>
        <button type="submit">付与</button>
    </form>    

</x-app-layout>