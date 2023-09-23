<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    
        <div class="menu">
            <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="button" onclick="location.href='./meeting/make'">新規作成</button>
            <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="button" onclick="location.href='./meeting/delete'">削除</button>
        </div>
        
        @foreach ($events as $event)
            <br/>
            <h2>
                <?php
                    if( $event->edit_limit < now()){
                ?>
                        <a href="/meeting/{{$event->id}}/decide" class="bg-red-100 text-red-800 text-1xl font-medium mr-2 px-4 py-1 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">{{ $event->title }}</a>
                <?php
                    }else{
                ?>
                        <a href="/meeting/{{$event->id}}/edit" class="bg-green-100 text-green-800 text-1xl font-medium mr-2 px-4 py-1 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">{{ $event->title }}</a>
                <?php        
                    }
                ?>        
            </h2>
            <p>入力期限：{{ $event->edit_limit }}</p>
            <a href="/meeting/{{$event->id}}/manual" class="bg-blue-100 text-blue-800 text-1xl font-medium mr-2 px-4 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">手入力</a>
        @endforeach
</x-app-layout>