<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600" dir="rtl" style="text-align: right">
            {{ __('site.text_inst_recover') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600" dir="rtl" style="text-align: right">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}" dir="rtl" style="text-align: right">
            @csrf

            <div class="block">
                <x-jet-label value="{{ __('site.email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('site.send_password_reset_link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
