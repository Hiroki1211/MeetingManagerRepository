<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('イベント作成') }}
        </h2>
    </x-slot>
        <form action="/meeting/make" method="POST">
            @csrf
            <div class="title">
                <p>タイトル：<input type="text" name="event[title]" /></p>
            </div>
            <div class="edit_limit"> 
                <p>入力期限：<input type="date" name="event[edit_limit]"></p>
            </div>
            <div class="day_start">
                <p>開始日：<input type="date" name="event[day_start]"></p>
            </div>
            <div class="day_end">
                <p>終了日：<input type="date" name="event[day_end]"></p>
            </div>
            <div class="rest">
                <input type="checkbox" id="scales" name="event[rest]" value="true" />
                <label for="scales">土日祝を含む</label>
            </div>
            <div class ="frame">
                <p>
                    1コマ：
                    <select name="event[frame]">
                        <option value = 10>10</option>
                        <option value = 20>20</option>
                        <option value = 30>30</option>
                        <option value = 60>60</option>
                        <option value = 90>90</option>
                    </select>
                    分
                </p>
            </div>
            <div class="time_start">
                <p>開始時刻：<input type="time" step="600" name="event[time_start]"></p>
            </div>
            <div class="time_end">
                <p>終了時刻：<input type="time" name="event[time_end]"></p>
            </div>
            <div class="locate">
                <p>場所：<input type="text" name="event[locate]" /></p>
            </div>
            <br/>
            <div class="comment">
                <!--nullable-->
                <p>コメント：<textarea name="event[comment]" ></textarea></p>
            </div>
            
            <button type="submit">イベント作成</button>

        </form>
</x-app-layout>