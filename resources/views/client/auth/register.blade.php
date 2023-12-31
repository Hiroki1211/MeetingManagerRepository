<x-guest-layout>
    <form method="POST" action="{{ route('client.register') }}">
        @csrf

        <div>
            <x-input-label for="group_id" :value="__('グループID')" />
            <x-text-input id="group_id" class="block mt-1 w-full" type="text" name="group_id" :value="old('group_id')" required autocomplete="group_id" />
            <x-input-error :messages="$errors->get('group_id')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name_last" :value="__('姓')" />
            <x-text-input id="name_last" class="block mt-1 w-full" type="text" name="name_last" :value="old('name_last')" required autocomplete="name_last" />
            <x-input-error :messages="$errors->get('name_last')" class="mt-2" />
        </div>
        
        <div>
            <x-input-label for="name_first" :value="__('名')" />
            <x-text-input id="name_first" class="block mt-1 w-full" type="text" name="name_first" :value="old('name_first')" required autocomplete="name_first" />
            <x-input-error :messages="$errors->get('name_first')" class="mt-2" />
        </div>
        
        <div>
            <x-input-label for="name_last_read" :value="__('セイ')" />
            <x-text-input id="name_last_read" class="block mt-1 w-full" type="text" name="name_last_read" :value="old('name_last_read')" required autocomplete="name_last_read" />
            <x-input-error :messages="$errors->get('name_last_read')" class="mt-2" />
        </div>
        
        <div>
            <x-input-label for="name_first_read" :value="__('メイ')" />
            <x-text-input id="name_first_read" class="block mt-1 w-full" type="text" name="name_first_read" :value="old('name_first_read')" required autocomplete="name_first_read" />
            <x-input-error :messages="$errors->get('name_first_read')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('client.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
