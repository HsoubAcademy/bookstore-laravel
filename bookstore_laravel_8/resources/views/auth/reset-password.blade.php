<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label value="{{ __('site.email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)"  autofocus />
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
                <x-jet-button>
                    {{ __('site.reset_password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
