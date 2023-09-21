<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    
        <div class="menu">
            <button type="button" onclick="location.href='./meeting/make'">新規作成</button>
            <button type="button" onclick="location.href='./meeting/delete'">削除</button>
        </div>
        
        @foreach ($events as $event)
            <h2>
                <?php
                    if( $event->edit_limit < now()){
                ?>
                        <a href="/meeting/{{$event->id}}/decide">{{ $event->title }}</a>
                <?php
                    }else{
                ?>
                        <a href="/meeting/{{$event->id}}/edit">{{ $event->title }}</a>
                <?php        
                    }
                ?>        
            </h2>
            <p>入力期限：{{ $event->edit_limit }}</p>
        @endforeach
</x-app-layout>