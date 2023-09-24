<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('日程確定') }}
        </h2>
    </x-slot>
    
    <form action="/meeting/{{$event->id}}/decide" method = "POST">
        @csrf
        
        <table>
            <tr>
                <th></th>
                <?php
                    
                    $start_array = [];
                    foreach ($hosts as $host){
                        $start_array[] = new DateTime($host->pivot->start);
                    }
                    
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
                $count = 0;
                while($count < count($start_array)-1){
                    $timeCount = 0;
                    while($time_end>=$time_start){
                        $timeCount += 1;
                        $time_print = $time_start->format('h-i');
            ?>
                        <tr>
                            <td>{{$time_print}}</td>
            <?php
                            $day=new DateTime($event['day_start']);
                            for($i = 0; $i < $cols; $i++){
                                $day_print = $day->format('y-m-d');
                                if($start_array[$count]->format('h-i') == $time_print && $start_array[$count]->format('y-m-d') == $day_print){
            ?>          
                                    <td></td>
            <?php
                                    if($count!= count($start_array) -1){
                                        $count += 1;
                                    }
                                }else{
                                    $name_last = [];
                                    $name_first = [];
                                    foreach( $clients as $temp ){
                                        $tempDatetime = new Datetime($temp->pivot->start);
                                        if($time_print == $tempDatetime->format('h-i') && $day_print == $tempDatetime->format('y-m-d')){
                                            $name_last[] = $temp-> name_last;
                                            $name_first[] = $temp -> name_first;
                                        }
                                    }
                                    if(count($name_last) == 0){
            ?>
                                        <td></td>
            <?php
                                    }else{
            ?>
                                        <td>
                                            <select name="register[]">
                                                <option value="">---</option>
                <?php                           
                                            for($i = 0; $i < count($name_last); $i++){
                ?>
                                                <option value = "{{$day_print}} {{$time_print}} {{$name_last[$i]}} {{$name_first[$i]}}">{{$name_last[$i]}} {{$name_first[$i]}}</option>
                <?php
                                                
                                            }
                ?>                            
                                            </select>
                                        </td>
            <?php
                                    }
                                }
                                $day->add(new DateInterval('P1D'));
                            }
            ?>
                        </tr>  
            <?php 
                        $time_start ->modify("+$frame minute");
                    }
                    $count = count($start_array)-1;
                }
            ?>
            
            
        </table>
        <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">決定</button>
    </form>
    
    
    <h2>登録情報
        
    <div class="overflow-x-scroll">    
        <table class="table-auto overflow-x-scroll w-11/12 ">
            <tr>
                <th></th>
                <?php
                    $day_start = new DateTime($event['day_start']);
                    $day_end = new DateTime($event['day_end']);
                    $day_end->add(new DateInterval('P1D'));
                    while( $day_end > $day_start){
                        $day_print = $day_start->format('m-d');
                ?>
                        <th colspan="{{$timeCount}}">{{$day_print}}</th>
                <?php
                        $day_start->add(new DateInterval('P1D'));
                    }
                ?>
            </tr>
            <tr>
                <td></td>
                <?php
                    for($i = 0; $i < $cols; $i++){
                        $time_start = new DateTime($event['time_start']);
                        $time_end = new DateTime($event['time_end']);
                        $frame = strval($event['frame']);
                        
                        while($time_end>=$time_start){
                            $time_print = $time_start->format('h-i');
                ?>
                            <td>{{$time_print}}</td>
                <?php
                            $time_start ->modify("+$frame minute");
                        }
                        
                    }
                ?>
            </tr>
            @foreach ($register as $value)
                <tr>
                    <td class="w-20 px-4 py-2">{{$value->name_last}} {{$value->name_first}}</td>
                    <?php
                        $time = [];
                        $count = 0;
                        foreach($clients as $temp){
                            if($temp->id == $value->id){
                                $time[] = new DateTime($temp->pivot->start);
                            }
                        }
                        $time[] = new Datetime('0000-00-00 00:00:00');
                        $day_start = new DateTime($event['day_start']);
                        $day_end = new DateTime($event['day_end']);
                        while( $day_end >= $day_start){
                            $time_start = new DateTime($event['time_start']);
                            $time_end = new DateTime($event['time_end']);
                            while( $time_end >= $time_start){
                                $day_print = $day_start->format('y-m-d');
                                $time_print = $time_start->format('h-i');
                                if($time[$count]->format('h-i') == $time_print && $time[$count]->format('y-m-d') == $day_print){
                    ?>
                                    <td class="w-20 px-4 py-2">〇</td>        
                    <?php

                                    if($count != count($time)-1){
                                        $count += 1;
                                    }
                                }else{
                    ?>
                                    <td class="w-20 px-4 py-2"></td>        
                    <?php
                                }
                                $time_start ->modify("+$frame minute");    
                            }
                            $day_start->add(new DateInterval('P1D'));
                        }
                    ?>
                    
                    
                    
                    
                    
                </tr>
            @endforeach
        </table>
    </div>
    
    
        
</x-app-layout>