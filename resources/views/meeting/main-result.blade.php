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
                        $day_print = $day->format('y-m-d');
                        if(count($time) == 0){
        ?>
                            <td></td>
        <?php
                        }else{
                            if($day_print == $time[$count]->format('y-m-d') && $time_print == $time[$count]->format('h-i')){
        ?>
                                <td>{{$name_last[$count]}} {{$name_first[$count]}}</td>
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
    
    <div class = "footer">
        <a href = "/meeting">戻る</a>
    </div>
    
        
</x-app-layout>