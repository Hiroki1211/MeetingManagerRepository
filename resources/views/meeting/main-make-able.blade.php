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
        
        <input type="hidden" name="tagID" value="">
        
        <input type="hidden" name="authID" value="{{ $authID }}">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-4 mr-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                    <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">{{$day_print}}</th>
                            <?php
                                    $day_start->add(new DateInterval('P1D'));
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">    
                        <?php
                            $time_start = new DateTime($event['time_start']);
                            $time_end = new DateTime($event['time_end']);
                            $frame = strval($event['frame']);
                            while($time_end>=$time_start){
                                $time_print = $time_start->format('h-i');
                        ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$time_print}}</td>
                        <?php
                                    $day=new DateTime($event['day_start']);
                                    for($i = 0; $i < $cols; $i++){
                                        $day_print = $day->format('y-m-d')
                        ?>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                            <input type="checkbox" name="start[]" value="{{$day_print. "-" .$time_print}}" class ="h-5 w-5 rounded border-gray-300">
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
                        
                    </tbody>    
                </table>
            </div>
        <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">メンバー選択</button>
    </form>
    
    
        
</x-app-layout>