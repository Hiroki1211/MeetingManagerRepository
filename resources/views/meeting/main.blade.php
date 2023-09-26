<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    
        <div class="menu mt-4 ml-4">
            <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="button" onclick="location.href='./meeting/make'">新規作成</button>
            <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="button" onclick="location.href='./meeting/delete'">削除</button>
        </div>
        
        @foreach ($events as $event)
            <br/>
            <div class="rounded border border-gray-500 py-6 px-20 mr-4 ml-4 bg-white">
                <h2 class="font-bold text-2xl">{{$event->title}}</h2>
                <p>入力期限：{{ $event->edit_limit }}</p>
                <a href="/meeting/{{$event->id}}/edit" class="bg-red-100 text-red-800 text-1xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">編集</a>
                <a href="/meeting/{{$event->id}}/manual" class="bg-blue-100 text-blue-800 text-1xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">手入力</a>
                <a href="/meeting/{{$event->id}}/decide" class="bg-green-100 text-green-800 text-1xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">日程調整</a>
                <a href="/meeting/{{$event->id}}/result" class="bg-gray-100 text-gray-800 text-1xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">結果出力</a>
            </div>
        @endforeach
</x-app-layout>