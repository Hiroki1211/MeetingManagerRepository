<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Member</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/table.css">
        <link rel="stylesheet" href="/css/button.css">
    </head>
    <body>
        <div class = "menu">
            <button type="button" onClick="location.href='./tag/make'">タグ作成</button>
            <button type="button">タグ削除</button>
        </div>
        <table class="y-scroll simple-table">
            <tr>
                <th class="simple-th"></th>
                <th class="simple-th">名前</th>
                <th class="simple-th">なまえ</th>
                <th class="simple-th">タグ</th>
                <th class="simple-th">ID</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td class="simple-td">
                        <input type="checkbox">
                    </td>
                    <td class="simple-td">{{ $user-> name_last}} {{ $user-> name_first}}</td>
                    <td class="simple-td">{{ $user-> name_last_read}} {{ $user-> name_first_read}}</td>
                    <td class="simple-td">3-1</td>
                    <td class="simple-td">{{ $user-> id }}</td>
                </tr>
            @endforeach
        </table>
        <dev class ="footer">
            <a href = "/meeting/member">戻る</a>
        </dev>
    </body>
</html>