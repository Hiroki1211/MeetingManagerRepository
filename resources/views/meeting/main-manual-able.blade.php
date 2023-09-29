<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('日程確定') }}
        </h2>
    </x-slot>
    
    <form action="/meeting/{{$event->id}}/manual/able" method = "POST">
        @csrf
        
        <input type="hidden" name="clientID" value ="{{$client->id}}">
        
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
                            while($count < count($start_array)-1){
                                $timeCount = 0;
                                while($time_end>=$time_start){
                                    $timeCount += 1;
                                    $time_print = $time_start->format('h-i');
                        ?>
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{$time_print}}</td>
                        <?php
                                        $day=new DateTime($event['day_start']);
                                        for($i = 0; $i < $cols; $i++){
                                            $day_print = $day->format('y-m-d');
                                            if($start_array[$count]->format('h-i') == $time_print && $start_array[$count]->format('y-m-d') == $day_print){
                        ?>          
                                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                                    
                                                </td>
                        <?php
                                                if($count!= count($start_array) -1){
                                                    $count += 1;
                                                }
                                            }else{
                        ?>
                                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                                    <input type="checkbox" name="start[]" value="{{$day_print. "-" .$time_print}}">
                                                </td>
                        
                        <?php                  
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
                    </tbody>
                    
                </table>
            </div>
        <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit">決定</button>
    </form>
    

</x-app-layout>