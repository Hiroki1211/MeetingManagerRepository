<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member 作成') }}
        </h2>
    </x-slot>
    
        <form action= "/meeting/member/make" method="POST">
            @csrf
            <div class="name_last">
                <p>性：<input type="text" name="user[name_last]"></p>
            </div>
            <div class="name_first">
                <p>名：<input type="text" name="user[name_first]"></p>
            </div>
            <div class="name_last_read">
                <p>セイ：<input type="text" name="user[name_last_read]"></p>
            </div>
            <div class="name_first_read">
                <p>メイ：<input type="text" name="user[name_first_read]"></p>
            </div>
            <div class="password">
                <p>パスワード：<input type="text" name="user[password]"></p>
            </div>
            
            <button type="submit">作成</button>
        </form>

</x-app-layout>