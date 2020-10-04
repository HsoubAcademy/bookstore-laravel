<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" dir="rtl" style="text-align: right">
            @csrf

            <div>
                <x-jet-label value="{{ __('site.name') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('site.email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')"  />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('site.password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password"  autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('site.password_confirmation') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation"  autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 ml-4" href="{{ route('login') }}">
                    {{ __('هل لديك حساب?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Site.register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
