<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タグ削除') }}
        </h2>
    </x-slot>

    <p>以下を削除しますか？</p>

    <form method="POST" action = "/meeting/member/tag">
        @csrf
        @method('DELETE')
        <table class="y-scroll simple-table">
            <tr>
                <th class="simple-th">ID</th>
                <th class="simple-th">名前</th>
                <th class="simple-th">色</th>
            </tr>
            @foreach ($tags as $tag)
                <tr>
                    <td class="simple-td">
                        {{$tag->id}}<input type="hidden" name="tagID[]" value="{{ $tag->id }}">
                    </td>
                    <td class="simple-td">{{ $tag->name }}</td>
                    <td class="simple-td">{{ $tag->color }}</td>
                </tr>
            @endforeach
        </table>

        <button type="submit">削除</button>
    </form>
    

</x-app-layout>

