<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
        <h1> Meeting Manager</h1>
        <button type="button" onclick="location.href='./meeting/make'">新規作成</button>
</x-app-layout>