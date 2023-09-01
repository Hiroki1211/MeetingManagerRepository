<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('イベント削除') }}
        </h2>
    </x-slot>

    <form action="/meeting/delete" method="POST">
        @csrf
        削除するイベントを選択
        <table>
            <tr>
                <th></th>
                <th>タイトル</th>
                <th>作成日時</th>
                <th>期間</th>
                <th>時間</th>
            </tr>
            @foreach ($events as $event)
                <tr>
                    <td><input type="checkbox" name="eventID[]" value="{{$event->id}}"></td>
                    <td>{{$event->title}}</td>
                    <td>{{$event->created_at}}</td>
                    <td>{{$event->day_start}} ～ {{$event->day_end}}</td>
                    <td>{{$event->time_start}} ～ {{$event->time_end}}</td>
                </tr>
            @endforeach
        </table>
        
        <button type="submit">削除</button>
        
    </form>

</x-app-layout>