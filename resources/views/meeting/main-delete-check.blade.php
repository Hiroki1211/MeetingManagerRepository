<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('イベント削除') }}
        </h2>
    </x-slot>

    <form action="/meeting/delete/check" method="POST">
        @csrf
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-4 mr-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">タイトル</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">作成日時</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">期間</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">時間</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        @foreach ($events as $event)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <input type="hidden" name="eventID[]" value="{{ $event->id }}">
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$event->title}}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$event->created_at}}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$event->day_start}} ～ {{$event->day_end}}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$event->time_start}} ～ {{$event->time_end}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        
        <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">削除</button>
        
    </form>

</x-app-layout>