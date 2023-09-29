<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('結果出力') }}
        </h2>
    </x-slot>
    
    <?php
        $time = [];
        foreach( $decided as $temp){
            $time[] = new DateTime($temp->pivot->start);
        }
        $count = 0;
    ?>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-4 mr-4 mb-4">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
            <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                        <th class=" text-left py-3 px-2 uppercase font-semibold text-sm">{{$day_print}}</th>
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
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-900">{{$time_print}}</td>
            <?php
                        $day=new DateTime($event['day_start']);
                        for($i = 0; $i < $cols; $i++){
                            $day_print = $day->format('y-m-d');
                            if(count($time) == 0){
            ?>
                                <td></td>
            <?php
                            }else{
                                if($day_print == $time[$count]->format('y-m-d') && $time_print == $time[$count]->format('h-i')){
            ?>
                                    <td class="whitespace-nowrap px-2 py-2 font-medium text-gray-900">{{$name_last[$count]}} {{$name_first[$count]}}</td>
            <?php                                     
                                    if($count != count($time)-1){
                                        $count += 1;
                                    }
                                }else{
            ?>
                                    <td></td>
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
            ?>
        
        </table>
    </div>
    
    <div class = "footer">
        <a href = "/meeting" class="mt-4 ml-4 bg-gray-100 text-gray-800 text-1xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">戻る</a>
    </div>
    
        
</x-app-layout>