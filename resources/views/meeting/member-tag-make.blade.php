<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タグ作成') }}
        </h2>
    </x-slot>

        <form action="/meeting/member/tag" method="POST">
            @csrf
            <div class = "mt-4 ml-4">
                <div class = "tag_name mb-2">
                    <p>名前</p>
                    <input type='text' name = 'tag[name]'>
                </div>
                <div class = "tag_color mb-2">
                    <p>色</p>
                    <select name = "tag[color]">
                        <option value= "red">赤</option>
                        <option value= "green">緑</option>
                        <option value= "blue">青</option>
                    </select>
                </div>
            </div>
            <button class="mt-4 ml-4 bg-green-700 hover:bg-green-600 text-white rounded px-4 py-2" type="submit" value="make">完了！</button>
        </form>
        <div class = "footer">
            <br/>
            <a href = "/meeting/member/tag" class ="mt-4 ml-4 footer bg-gray-100 text-gray-800 text-1xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">戻る</a>
        </div>

</x-app-layout>

