@extends('layouts.auth')

@section('content')
<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ 'http://api_gateway.local:81/login/' }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Почта:')" />
            <x-text-input id="email" class="block mt-1 w-full email_type" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Пароль:')" />

            <x-text-input id="password" class="block mt-1 w-full password_type"
                            type="password"
                            name="password"
                            required autocomplete="off" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center checkbox_type_label">
                <input id="remember_me" type="checkbox" class="rounded checkbox_type" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Запомнить') }}</span>
            </label>
        </div>
        
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Забыли пароль?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 login_button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
@endsection
