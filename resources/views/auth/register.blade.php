<head>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/construction.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
</head>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            
        </x-slot>

        <x-jet-validation-errors class="mb-4" /> 
        
        <form method="POST" action="{{ route('register') }}">

            <h1 class="" style="font-size: 25pt;color:#6756be; margin-bottom:10%"><strong><center> ثبت نام کاربر </center></strong></h1>
            <center><img src="assets/images/attached-files/1212.jpg" style="width: 70%" class="col-lg-12" alt=""></center>
            @csrf

            <div>
                <x-jet-label style="float: right" for="name" value="{{ __('اسم') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label style="float: right" for="email" value="{{ __('ایمیل') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label style="float: right" for="password" value="{{ __('رمز عبور') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label style="float: right" for="password_confirmation" value="{{ __('تایید رمز عبور') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('قبلا ثبت نام کرده اید؟') }}
                </a>
                <a href="{{URL::asset('/')}}" onclick="back()"> 
                    <button class="btn pt-1 pb-1 ml-4" style="border-color: #6756be;">
                    برگشت
                    </button>
                </a>

                <x-jet-button class="ml-4" id="btn4" style="background-color: #6756be">
                    {{ __('ثبت نام') }}
                </x-jet-button>
               
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
<script>
    function back(){
        location.href = 'http://127.0.0.1:8000/';
    }
</script>
