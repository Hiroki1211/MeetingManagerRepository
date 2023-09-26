<x-client-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('結果') }}
        </h2>
    </x-slot>

    <?php
        $registered = new DateTime($registered);
    ?>
    
    <br/>
    <div class="rounded border border-gray-500 py-6 px-20 mr-4 ml-4 bg-white">
        <h2 class="font-bold text-2xl">{{$event->title}}</h2>
        <p>日程：{{$registered->format('y-m-d')}}</p>
        <p>時間：{{$registered->format('h-i')}}</p>
        <p>場所：{{$event->locate}}</p>
        <p>説明：{{$event->comment}}</p>
    </div>
    
</x-client-layout>
