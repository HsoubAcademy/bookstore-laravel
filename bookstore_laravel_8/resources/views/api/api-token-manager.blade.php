<div>
    <!-- Generate API Token -->
    <x-jet-form-section submit="createApiToken">
        <x-slot name="title">
            {{ __('إنشاء رمز API') }}
        </x-slot>

        <x-slot name="description">
            {{ __('تسمح الرموز المميزة لواجهة برمجة التطبيقات لخدمات الجهات الخارجية بالمصادقة مع تطبيقنا نيابة عنك.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Token Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('اسم الرمز') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="createApiTokenForm.name" autofocus />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <!-- Token Permissions -->
            @if (Laravel\Jetstream\Jetstream::hasPermissions())
                <div class="col-span-6">
                    <x-jet-label for="permissions" value="{{ __('الأذونات') }}" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" value="{{ $permission }}" wire:model.defer="createApiTokenForm.permissions">
                                <span class="ml-2 text-sm text-gray-600">{{ $permission }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="created">
                {{ __('تم الإنشاء.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('إنشاء') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    @if ($this->user->tokens->isNotEmpty())
        <x-jet-section-border />

        <!-- Manage API Tokens -->
        <div class="mt-10 sm:mt-0">
            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('إدارة رموز API') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('يمكنك حذف أي من الرموز المميزة الموجودة لديك إذا لم تعد هناك حاجة إليها.') }}
                </x-slot>

                <!-- API Token List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <div class="flex items-center justify-between">
                                <div>
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-gray-400">
                                            {{ __('Last used') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Laravel\Jetstream\Jetstream::hasPermissions())
                                        <button class="cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none" wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('الأذونات') }}
                                        </button>
                                    @endif

                                    <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('حذف') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-action-section>
        </div>
    @endif

    <!-- Token Value Modal -->
    <x-jet-dialog-modal wire:model="displayingToken">
        <x-slot name="title">
            {{ __('رمز API') }}
        </x-slot>

        <x-slot name="content">
            <div>
                {{ __('يرجى نسخ رمز API الجديد الخاص بك. من أجل أمانك ، لن يتم عرضه مرة أخرى.') }}
            </div>

            <div class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500">
                {{ $plainTextToken }}
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('إغلاق') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- API Token Permissions Modal -->
    <x-jet-dialog-modal wire:model="managingApiTokenPermissions">
        <x-slot name="title">
            {{ __('أذونات رمز API') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox" value="{{ $permission }}" wire:model.defer="updateApiTokenForm.permissions">
                        <span class="ml-2 text-sm text-gray-600">{{ $permission }}</span>
                    </label>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
                {{ __('لا') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updateApiToken" wire:loading.attr="disabled">
                {{ __('حفظ') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete Token Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingApiTokenDeletion">
        <x-slot name="title">
            {{ __('حذف رمز API') }}
        </x-slot>

        <x-slot name="content">
            {{ __('هل أنت متأكد أنك تريد حذف رمز API المميز هذا؟') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled">
                {{ __('لا') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteApiToken" wire:loading.attr="disabled">
                {{ __('حذف') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
