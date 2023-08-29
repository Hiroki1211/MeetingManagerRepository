<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('選択不可日程選択') }}
        </h2>
    </x-slot>
    
    <form>
        <table>
            <tr>
                <th></th>
                <?php
                    $cols = 0;
                    $day_start = new DateTime($event->day_start);
                    $day_end = new DateTime($event->day_end);
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
                $time_start = new DateTime($event -> time_start);
                $time_end = new DateTime($event -> time_end);
                $frame = new DateTime($event -> frame );
                $frame_print = $frame-> format('i');
                $frame_in = '+$frame_print minute';
                while($time_end>=$time_start){
                    $time_print = $time_start->format('h-i');
                    $time_start ->modify($frame);
            ?>
                    <tr>
                        <td>{{$time_print}}</td>
            <?php
                        for($i = 0; $i < $cols; $i++){
            ?>
                            <td>
                                <input type="checkbox">
                            </td>
            <?php
                        }
            ?>
                    </tr>  
            <?php        
                }
            ?>
            
            
        </table>
    </form>
    
    
        
</x-app-layout>