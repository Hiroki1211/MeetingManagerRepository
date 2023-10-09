<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('イベント編集') }}
        </h2>
    </x-slot>
        <form action="/meeting/{{$event->id}}/edit" method="POST">
            @csrf
            @method('PUT')
            <div class = "mt-4 ml-4">
                <div class="title mb-2">
                    <p>タイトル：<input type="text" name="event[title]" value="{{ $event->title }}"/></p>
                </div>
                <p class="notChoose__error" style="color:red">{{ $errors->first('event.title') }}</p>
                <div class="edit_limit mb-2"> 
                    <p>入力期限：<input type="date" name="event[edit_limit]" value="{{ $event->edit_limit }}"></p>
                </div>
                <p class="notChoose__error" style="color:red">{{ $errors->first('event.edit_limit') }}</p>
                <div class="day_start mb-2">
                    <p>開始日：<input type="date" name="event[day_start]" value="{{$event->day_start}}"></p>
                </div>
                <p class="notChoose__error" style="color:red">{{ $errors->first('event.day_start') }}</p>
                <div class="day_end mb-2">
                    <p>終了日：<input type="date" name="event[day_end]" value="{{$event->day_end}}"></p>
                </div>
                <p class="notChoose__error" style="color:red">{{ $errors->first('event.day_end') }}</p>
                <div class ="frame mb-2">
                    <p>
                        1コマ：
                        <select name="event[frame]">
                            <?php
                                if($event->frame == 10){
                            ?>
                                <option value = 10 selected>10</option>
                            <?php
                                }else{
                            ?>
                                <option value = 10 >10</option>
                            <?php
                                }
                            
                            ?>
                            <?php
                                if($event->frame == 20){
                            ?>
                                <option value = 20 selected>20</option>
                            <?php
                                }else{
                            ?>
                                <option value = 20 >20</option>
                            <?php
                                }
                            
                            ?><?php
                                if($event->frame == 30){
                            ?>
                                <option value = 30 selected>30</option>
                            <?php
                                }else{
                            ?>
                                <option value = 30 >30</option>
                            <?php
                                }
                            
                            ?><?php
                                if($event->frame == 60){
                            ?>
                                <option value = 60 selected>60</option>
                            <?php
                                }else{
                            ?>
                                <option value = 60 >60</option>
                            <?php
                                }
                            
                            ?><?php
                                if($event->frame == 90){
                            ?>
                                <option value = 90 selected>90</option>
                            <?php
                                }else{
                            ?>
                                <option value = 90 >90</option>
                            <?php
                                }
                            
                            ?>
                        </select>
                        分
                    </p>
                </div>
                <div class="time_start mb-2">
                    <p>開始時刻：<input type="time" step="600" name="event[time_start]" value="{{$event->time_start}}"></p>
                </div>
                <p class="notChoose__error" style="color:red">{{ $errors->first('event.time_start') }}</p>
                <div class="time_end mb-2">
                    <p>終了時刻：<input type="time" name="event[time_end]" value="{{$event->time_end}}"></p>
                </div>
                <p class="notChoose__error" style="color:red">{{ $errors->first('event.time_end') }}</p>
                <div class="locate mb-2">
                    <p>場所：<input type="text" name="event[locate]" value="{{$event->locate}}"/></p>
                </div>
                <p class="notChoose__error" style="color:red">{{ $errors->first('event.locate') }}</p>
                <div class="comment mb-2">
                    <!--nullable-->
                    <p>コメント：<textarea name="event[comment]" value="{{$event->comment}}"></textarea></p>
                </div>
            </div>
            
            <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">イベント編集</button>

        </form>
</x-app-layout>