<x-jet-action-section>
    <x-slot name="title">
        {{ __('المصادقة الثنائية') }}
    </x-slot>

    <x-slot name="description">
        {{ __('أضف أمانًا إضافيًا إلى حسابك باستخدام المصادقة الثنائية') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                {{ __('لقد قمت بتمكين المصادقة الثنائية.') }}
            @else
                {{ __('لم تقم بتمكين المصادقة الثنائية.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('عند تمكين المصادقة الثنائية ، ستتم مطالبتك برمز آمن وعشوائي أثناء المصادقة. يمكنك استرداد هذا الرمز المميز من تطبيق Google Authenticator بهاتفك') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('تم تمكين المصادقة الثنائية، الآن امسح رمز الاستجابة السريعة التالي ضوئيًا باستخدام تطبيق المصادقة على هاتفك.') }}
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('قم بتخزين رموز الاسترداد هذه في مدير كلمات مرور آمن. يمكن استخدامها لاستعادة الوصول إلى حسابك في حالة فقد جهاز المصادقة الثنائية الخاص بك.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('تمكين') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('إعادة إنشاء رموز الاسترداد') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('إظهار رموز الاسترداد') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        {{ __('تعطيل') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
