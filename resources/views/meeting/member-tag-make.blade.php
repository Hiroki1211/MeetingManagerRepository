<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タグ作成') }}
        </h2>
    </x-slot>

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
            <button class="bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit" value="make">完了！</button>
        </form>
        <div class = "footer">
            <br/>
            <a href = "/meeting/member/tag">戻る</a>
        </div>

</x-app-layout>

