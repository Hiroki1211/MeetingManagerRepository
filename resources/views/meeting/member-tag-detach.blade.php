<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タグ剥奪') }}
        </h2>
    </x-slot>
    
        <form action="/meeting/member/tag/detach" method = "POST">
            @csrf
            
            <div class="mt-4 ml-4">
                <p>剥奪するタグを選択してください</p>
                @foreach ($tags as $tag)
                    <input type = "radio" name="tagID" value="{{$tag->id}}"> {{$tag->name}}
                    <br/>
                @endforeach
            </div>
            
            <p class="notChoose__error" style="color:red">{{ $errors->first('tag.required') }}</p>
            
            <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">決定</button>
        </form>
        
        
</x-app-layout>