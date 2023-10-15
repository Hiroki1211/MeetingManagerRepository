<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メンバー変更') }}
        </h2>
    </x-slot>
    
    <?php
        $registeredID = [];
        foreach($registered as $value){
            $registeredID[] = $value->id;
        }
    ?>
    
    

    <form action="/meeting/{{$event->id}}/edit/able/member" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="event[id]" value ="{{$event->id}}">
        <input type="hidden" name="event[title]" value ="{{$event->title}}">
        <input type="hidden" name="event[edit_limit]" value ="{{$event->edit_limit}}">
        <input type="hidden" name="event[day_start]" value ="{{$event->day_start}}">
        <input type="hidden" name="event[day_end]" value ="{{$event->day_end}}">
        <input type="hidden" name="event[frame]" value ="{{$event->frame}}">
        <input type="hidden" name="event[time_start]" value ="{{$event->time_start}}">
        <input type="hidden" name="event[time_end]" value ="{{$event->time_end}}">
        <input type="hidden" name="event[locate]" value ="{{$event->locate}}">
        <input type="hidden" name="event[comment]" value ="{{$event->comment}}">
        
        <input type="hidden" name="authID" value="{{ $authID }}">
        
        @foreach ($start as $value)
            <input type="hidden" name="start[]" value="{{$value}}">
        @endforeach
        
        <?php
            $i = 0;
        ?>
            <div class="ml-4 mt-4">
                <select name="tagID" >
                    <option value="" selected>-----</option>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>                
                <button type="submit" class="mr-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" formaction = "/meeting/{{$event->id}}/edit/able">絞り込み</button>                  
            </div>
        
           <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 ml-4 mr-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th></th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">名前</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">なまえ</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">タグ</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">e-mail</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        @foreach ($clients as $client)
                            <tr>
                <?php
                                    
                                    if($client->id == $registeredID[$i]){
                ?>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        <input  type="checkbox" name="clientID[]" value="{{ $client->id }}" checked>
                                    </td>
                <?php
                                        if($i != count($registeredID)-1){
                                            $i += 1;
                                        }
                                    }else{
                ?>
                                    <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                        <input  type="checkbox" name="clientID[]" value="{{ $client->id }}">
                                    </td>
                <?php
                                    }
                ?>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $client-> name_last}} {{ $client-> name_first}}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $client-> name_last_read}} {{ $client-> name_first_read}}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                    @foreach($client->tags as $tag)
                                        <?php
                                            if($tag->color == "red"){
                                        ?>
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                                                {{ $tag->name }}
                                            </span>
                                        <?php
                                            }else if($tag->color == "green"){
                                        ?>
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">
                                                {{ $tag->name }}
                                            </span>
                                        <?php
                                            }else if($tag->color == "blue"){
                                        ?>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                                {{ $tag->name }}
                                            </span>
                                        <?php
                                            }
                                        ?>
                                    @endforeach</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $client-> id }}</td>
                                <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $client-> email}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit" formaction = "/meeting/{{$event->id}}/edit/able/member">作成</button>
    </form>


</x-app-layout>
