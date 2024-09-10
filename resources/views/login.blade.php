@extends('layouts.auth')

@section('content')
    <div>
        @if (session('errors'))
            @foreach($errors->all() as $error)
                <div class="validation_errors_alert">{{ $error }}</div>
            @endforeach
        @endif
    </div>
    <div>
        <form method="POST" action="{{ 'http://api_gateway.local:81/signin/' }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label class="block font-medium text-sm text-gray-700" for="email">Почта:</label>
                <input id="email" class="block mt-1 w-full form_login_type email_type" 
                                type="email" 
                                name="email"
                                value="{{ old('email') }}"
                                required autofocus autocomplete="off" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Пароль:</label>
                <input id="password" class="block mt-1 w-full form_login_type password_type"
                                type="password"
                                name="password"
                                required autocomplete="off" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center checkbox_type_label">
                    <input id="remember_me" type="checkbox" class="rounded form_login_type_check checkbox_type" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Запомнить') }}</span>
                </label>
            </div>
            
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ url('http://api_gateway.local:81/signin') }}">
                        {{ __('Забыли пароль?') }}
                    </a>
                @endif

                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3 login_button">
                    {{ __('Войти') }}
                </button>
            </div>
        </form>
    </div>
@endsection