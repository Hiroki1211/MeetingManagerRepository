<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client 作成') }}
        </h2>
    </x-slot>
    
        <form action= "/meeting/client/member/make" method="POST">
            @csrf
            <div class = "mt-4 ml-4">
                <div class="name_last mb-2">
                    <p>性：<input type="text" name="client[name_last]"></p>
                </div>
                <div class="name_first mb-2">
                    <p>名：<input type="text" name="client[name_first]"></p>
                </div>
                <div class="name_last_read mb-2">
                    <p>セイ：<input type="text" name="client[name_last_read]"></p>
                </div>
                <div class="name_first_read mb-2">
                    <p>メイ：<input type="text" name="client[name_first_read]"></p>
                </div>
                <div class="password mb-2">
                    <p>パスワード：<input type="text" name="client[password]"></p>
                </div>
            </div>
            
            <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">作成</button>
        </form>

</x-app-layout>