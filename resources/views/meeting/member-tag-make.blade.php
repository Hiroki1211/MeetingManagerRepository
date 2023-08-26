<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Member</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <form action="/meeting/member/tag" method="POST">
            @csrf
            <div class = "tag_name">
                <p>名前</p>
                <input type='text' name = 'tag[name]'>
            </div>
            <div class = "tag_color">
                <p>色</p>
                <select name = "tag[color]">
                    <option value= "red">赤</option>
                    <option value= "green">緑</option>
                    <option value= "blue">青</option>
                </select>
            </div>
            <br/>
            <button type="submit" value="make">完了！</button>
        </form>
        <div class = "footer">
            <br/>
            <a href = "/meeting/member/tag">戻る</a>
        </div>
    </body>
</html>