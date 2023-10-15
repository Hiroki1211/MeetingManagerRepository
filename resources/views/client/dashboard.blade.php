<x-client-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Main') }}
        </h2>
    </x-slot>

    @foreach($events as $event)
        <br/>
        <div class="rounded border border-gray-500 py-6 px-20 mr-4 ml-4 bg-white">
            <h2 class="font-bold text-2xl">{{$event->title}}</h2>
            <p>入力期限：{{ $event->edit_limit }}</p>
            <p>場所　　：{{ $event->locate }}</p>
            <a href="/client/{{$event->id}}/edit" class="bg-red-100 text-red-800 text-1xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">入力</a>
            <?php
                $temp = $event->clients()->where([
                    ['id', '=', Auth::guard('client')->user()->id],
                    ['start', '<>', NULL],
                    ['register', '<>', NULL],
                ])->get();

                if($temp->isNotEmpty()){
            ?>
                <a href="/client/{{$event->id}}/result" class="bg-blue-100 text-blue-800 text-1xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">結果</a>
            <?php
                }
            ?>
        </div>
    @endforeach
    
</x-client-layout>
