<head>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/construction.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
</head>
<x-guest-layout>
    
    <x-jet-authentication-card class="">
        <x-slot name="logo">
            {{-- <h1 class="text bg-white rounded-lg p-3 shadow-sm" style="font-size: 50pt; color:#6756be"><strong> login </strong></h1> --}}
        </x-slot>
        
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="container">
                <h1 class="" style="font-size:25pt; color:#6756be; margin-bottom:10px"><strong><center> ورود کاربر </center></strong></h1>
                <img src="assets/images/attached-files/20944201.jpg" class="col-lg-12" width="70%" alt="">
                <div>
                    <x-jet-label for="email" style="float: right;" value="{{ __('ایمیل') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" style="float: right" value="{{ __('رمز') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4" style="direction:rtl">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600 mr-2">{{ __('مرا به خاطر بسپار') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('رمز ورود را فراموش کرده اید؟') }}
                        </a>
                    @endif
                    <a href="{{URL::asset('/')}}" onclick="back()"> 
                        <button class="btn pt-1 pb-1 ml-4" style="border-color: #6756be;">
                        برگشت
                        </button>
                    </a>

                    <x-jet-button class="ml-4" style="background-color: #6756be">
                        {{ __('ورود') }}
                    </x-jet-button>
                </div>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
<script>
    function back(){
        location.href = 'http://127.0.0.1:8000/';
    }
</script>
