<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('選択不可日程選択') }}
        </h2>
    </x-slot>
    
    <form action="/meeting/make/able" method = "POST">
        @csrf
        
        <input type="hidden" name="event[title]" value ="{{$event['title']}}">
        <input type="hidden" name="event[edit_limit]" value ="{{$event['edit_limit']}}">
        <input type="hidden" name="event[day_start]" value ="{{$event['day_start']}}">
        <input type="hidden" name="event[day_end]" value ="{{$event['day_end']}}">
        <input type="hidden" name="event[frame]" value ="{{$event['frame']}}">
        <input type="hidden" name="event[time_start]" value ="{{$event['time_start']}}">
        <input type="hidden" name="event[time_end]" value ="{{$event['time_end']}}">
        <input type="hidden" name="event[locate]" value ="{{$event['locate']}}">
        <input type="hidden" name="event[comment]" value ="{{$event['comment']}}">
        
        <input type="hidden" name="authID" value="{{ $authID }}">
        <table>
            <tr>
                <th></th>
                <?php
                    $cols = 0;
                    $day_start = new DateTime($event['day_start']);
                    $day_end = new DateTime($event['day_end']);
                    $day_end->add(new DateInterval('P1D'));
                    while( $day_end > $day_start){
                        $cols = $cols + 1;
                        $day_print = $day_start->format('m-d');
                ?>
                        <th>{{$day_print}}</th>
                <?php
                        $day_start->add(new DateInterval('P1D'));
                    }
                ?>
            </tr>
            
            <?php
                $time_start = new DateTime($event['time_start']);
                $time_end = new DateTime($event['time_end']);
                $frame = strval($event['frame']);
                while($time_end>=$time_start){
                    $time_print = $time_start->format('h-i');
            ?>
                    <tr>
                        <td>{{$time_print}}</td>
            <?php
                        $day=new DateTime($event['day_start']);
                        for($i = 0; $i < $cols; $i++){
                            $day_print = $day->format('y-m-d')
            ?>
                            <td>
                                <input type="checkbox" name="start[]" value="{{$day_print. "-" .$time_print}}">
                            </td>
            <?php
                            $day->add(new DateInterval('P1D'));
                        }
            ?>
                    </tr>  
            <?php 
                    $time_start ->modify("+$frame minute");
                }
            ?>
            
            
        </table>
        <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">メンバー選択</button>
    </form>
    
    
        
</x-app-layout>