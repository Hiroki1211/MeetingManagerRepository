<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('イベント作成') }}
        </h2>
    </x-slot>
        <form action="" method="POST">
            @csrf
            <div class="title">
                <p>タイトル</p>
                <input type="text" name="event[title]" />
            </div>
            <div class="edit_limit"> 
                nullable
                <p>入力期限</p>
            </div>
            <div class="day_start">
                <p>開始日</p>
            </div>
            <div class="day_end">
                <p>終了日</p>
            </div>
            <div class="rest">
                <p>土日祝を含む</p>
            </div>
            <div class ="frame">
                <p>1コマ</p>
            </div>
            <div class="time_start">
                <p>開始時刻</p>
            </div>
            <div class="time_end">
                <p>終了時刻</p>
            </div>
            <div class="locate">
                <p>場所</p>
                <input type="text" name="event[locate]" />
            </div>
            <div class="comment">
                nullable
                <p>コメント</p>
                <textarea name="event[comment]" ></textarea>
            </div>

        </form>
</x-app-layout>