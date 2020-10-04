<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" dir="rtl" style="text-align: right">
            @csrf

            <div>
                <x-jet-label value="{{ __('site.email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('site.password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password"  autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('site.remember_me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 ml-4" href="{{ route('password.request') }}">
                        {{ __('site.forgot_password') }}?
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('site.login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
