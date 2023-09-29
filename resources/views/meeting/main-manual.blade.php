<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manual') }}
        </h2>
    </x-slot>
    
        <form action="/meeting/{{$event->id}}/manual" method = "POST">
            @csrf
            
            <div class="mt-4 ml-4">
                <p>入力する人を選択してください</p>
                @foreach ($register as $client)
                    <input type = "radio" name="clientID" value="{{$client->id}}"> {{$client->name_last}} {{$client->name_first}}
                    <br/>
                @endforeach
            </div>
            
            <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">決定</button>
        </form>
        
        
</x-app-layout>