<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member') }}
        </h2>
    </x-slot>
    

    
        <table class="y-scroll simple-table">
            <tr>
                <th></th>
                <th class="simple-th">名前</th>
                <th class="simple-th">なまえ</th>
                <th class="simple-th">タグ</th>
                <th class="simple-th">ID</th>
                <th class="simple-th">e-mail</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td class="simple-td">{{ $user-> name_last}} {{ $user-> name_first}}</td>
                    <td class="simple-td">{{ $user-> name_last_read}} {{ $user-> name_first_read}}</td>
                    <td class="simple-td">3-1</td>
                    <td class="simple-td">{{ $user-> id }}</td>
                    <td class="simple-td">{{ $user-> email}}</td>
                </tr>
            @endforeach
        </table>

</x-app-layout>