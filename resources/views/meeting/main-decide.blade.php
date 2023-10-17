<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('日程確定') }}
        </h2>
    </x-slot>
    
    <form action="/meeting/{{$event->id}}/decide" method = "POST">
        @csrf
        
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-4 mr-4">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                            $day_tmp = $day_start->format('Y-m-d');
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
                    $count = 0;
                    $timeCount = 0;
                                
                    while($time_end>=$time_start){
                        $timeCount += 1;
                        $time_print = $time_start->format('h-i');  
                        $time_tmp = $time_start->format('h:i:s');
        ?>
                        <tr>
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$time_print}}</td>
        <?php        
                            $day_start = new DateTime($event['day_start']);
                            $day_end = new DateTime($event['day_end']);
                            $day_end->add(new DateInterval('P1D'));    
                            while($day_end > $day_start){
                                $day_print = $day_start->format('y-m-d');
                                $day_tmp = $day_start->format('Y-m-d');
                                if($start_array[$count]->format('h-i') == $time_print && $start_array[$count]->format('y-m-d') == $day_print){
        ?>          
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></td>
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
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                            <select name="register[]">
                                                <option value="">---</option>
        <?php                           
                                                for($i = 0; $i < count($name_last); $i++){
        ?>
                                                    <option value = "{{$day_tmp}} {{$time_tmp}} {{$name_last[$i]}} {{$name_first[$i]}}">{{$name_last[$i]}} {{$name_first[$i]}}</option>
        <?php
                                                            
                                                }
                            ?>                            
                                            </select>
                                        </td>
        <?php
                                    }
                    }
                    $day_start->add(new DateInterval('P1D'));
                }
            $time_start ->modify("+$frame minute");
        }
        ?>
                </tbody>
            </table>        
        </div>

        <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">決定</button>
    </form>
    
    
    <h2 class = "mt-4 ml-4 font-bold text-2xl">登録情報</h2>
        
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-4 mr-4 md-4">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th></th>
                        <?php
                            $day_start = new DateTime($event['day_start']);
                            $day_end = new DateTime($event['day_end']);
                            $day_end->add(new DateInterval('P1D'));
                            while( $day_end > $day_start){
                                $day_print = $day_start->format('m-d');
                        ?>
                                <th colspan="{{$timeCount}}" class=" text-left py-3 px-4 uppercase font-semibold text-sm">{{$day_print}}</th>
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
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$time_print}}</td>
                        <?php
                                    $time_start ->modify("+$frame minute");
                                }
                                
                            }
                        ?>
                    </tr>
                    </thead>
                <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    @foreach ($register as $value)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$value->name_last}} {{$value->name_first}}</td>
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
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">〇</td>        
                            <?php
        
                                            if($count != count($time)-1){
                                                $count += 1;
                                            }
                                        }else{
                            ?>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"></td>        
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
    </br>
    
        
</x-app-layout>