<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メンバー選択') }}
        </h2>
    </x-slot>

    <form action="/meeting/make/able/member" method="POST">
        @csrf
        <input type="hidden" name="authID" value = "{{$authID}}">
        <input type="hidden" name="event[title]" value ="{{$event['title']}}">
        <input type="hidden" name="event[edit_limit]" value ="{{$event['edit_limit']}}">
        <input type="hidden" name="event[day_start]" value ="{{$event['day_start']}}">
        <input type="hidden" name="event[day_end]" value ="{{$event['day_end']}}">
        <input type="hidden" name="event[frame]" value ="{{$event['frame']}}">
        <input type="hidden" name="event[time_start]" value ="{{$event['time_start']}}">
        <input type="hidden" name="event[time_end]" value ="{{$event['time_end']}}">
        <input type="hidden" name="event[locate]" value ="{{$event['locate']}}">
        <input type="hidden" name="event[comment]" value ="{{$event['comment']}}">
        @foreach ($start as $value)
            <input type="hidden" name="start[]" value="{{$value}}">
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
                            <input  type="checkbox" name="userID[]" value="{{ $user->id }}">
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

        <button type="submit">作成</button>
    </form>


</x-app-layout>
