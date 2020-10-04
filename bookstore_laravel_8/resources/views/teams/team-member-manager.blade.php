<div>
    @if (Gate::check('addTeamMember', $team))
        <x-jet-section-border />

        <!-- Add Team Member -->
        <div class="mt-10 sm:mt-0">
            <x-jet-form-section submit="addTeamMember">
                <x-slot name="title">
                    {{ __('إضافة عضو الفريق') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('أضف عضوًا جديدًا إلى فريقك، مما يتيح لهم التعاون معك.') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6">
                        <div class="max-w-xl text-sm text-gray-600">
                            {{ __('يرجى تقديم عنوان البريد الإلكتروني للشخص الذي ترغب في إضافته إلى هذا الفريق. يجب أن يكون عنوان البريد الإلكتروني مرتبطًا بحساب موجود.') }}
                        </div>
                    </div>

                    <!-- Member Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="email" value="{{ __('البريد الإلكتروني') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="addTeamMemberForm.email" />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <!-- Role -->
                    @if (count($this->roles) > 0)
                        <div class="col-span-6 lg:col-span-4">
                            <x-jet-label for="role" value="{{ __('الدور') }}" />
                            <x-jet-input-error for="role" class="mt-2" />

                            <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
                                @foreach ($this->roles as $index => $role)
                                        <div class="px-4 py-3 {{ $index > 0 ? 'border-t border-gray-200' : '' }}"
                                                        wire:click="$set('addTeamMemberForm.role', '{{ $role->key }}')">
                                            <div class="{{ isset($addTeamMemberForm['role']) && $addTeamMemberForm['role'] !== $role->key ? 'opacity-50' : '' }}">
                                                <!-- Role Name -->
                                                <div class="flex items-center">
                                                    <div class="text-sm text-gray-600 {{ $addTeamMemberForm['role'] == $role->key ? 'font-semibold' : '' }}">
                                                        {{ $role->name }}
                                                    </div>

                                                    @if ($addTeamMemberForm['role'] == $role->key)
                                                        <svg class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    @endif
                                                </div>

                                                <!-- Role Description -->
                                                <div class="mt-2 text-xs text-gray-600">
                                                    {{ $role->description }}
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </x-slot>

                <x-slot name="actions">
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __('تمت الإضافة.') }}
                    </x-jet-action-message>

                    <x-jet-button>
                        {{ __('إضافة') }}
                    </x-jet-button>
                </x-slot>
            </x-jet-form-section>
        </div>
    @endif

    @if ($team->users->isNotEmpty())
        <x-jet-section-border />

        <!-- Manage Team Members -->
        <div class="mt-10 sm:mt-0">
            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('أعضاء الفريق') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('كل الأشخاص الذين هم جزء من هذا الفريق.') }}
                </x-slot>

                <!-- Team Member List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($team->users->sortBy('name') as $user)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img class="w-8 h-8 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                    <div class="ml-4">{{ $user->name }}</div>
                                </div>

                                <div class="flex items-center">
                                    <!-- Manage Team Member Role -->
                                    @if (Gate::check('addTeamMember', $team) && Laravel\Jetstream\Jetstream::hasRoles())
                                        <button class="ml-2 text-sm text-gray-400 underline" wire:click="manageRole('{{ $user->id }}')">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </button>
                                    @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                                        <div class="ml-2 text-sm text-gray-400">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </div>
                                    @endif

                                    <!-- Leave Team -->
                                    @if ($this->user->id === $user->id)
                                        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="$toggle('confirmingLeavingTeam')">
                                            {{ __('غادر') }}
                                        </button>

                                    <!-- Remove Team Member -->
                                    @elseif (Gate::check('removeTeamMember', $team))
                                        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="confirmTeamMemberRemoval('{{ $user->id }}')">
                                            {{ __('إزالة') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-action-section>
        </div>
    @endif

    <!-- Role Management Modal -->
    <x-jet-dialog-modal wire:model="currentlyManagingRole">
        <x-slot name="title">
            {{ __('إدارة الدور') }}
        </x-slot>

        <x-slot name="content">
                <div class="mt-1 border border-gray-200 rounded-lg cursor-pointer">
                    @foreach ($this->roles as $index => $role)
                        <div class="px-4 py-3 {{ $index > 0 ? 'border-t border-gray-200' : '' }}"
                                        wire:click="$set('currentRole', '{{ $role->key }}')">
                            <div class="{{ $currentRole !== $role->key ? 'opacity-50' : '' }}">
                                <!-- Role Name -->
                                <div class="flex items-center">
                                    <div class="text-sm text-gray-600 {{ $currentRole == $role->key ? 'font-semibold' : '' }}">
                                        {{ $role->name }}
                                    </div>

                                    @if ($currentRole == $role->key)
                                        <svg class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @endif
                                </div>

                                <!-- Role Description -->
                                <div class="mt-2 text-xs text-gray-600">
                                    {{ $role->description }}
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="stopManagingRole" wire:loading.attr="disabled">
                {{ __('لا') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updateRole" wire:loading.attr="disabled">
                {{ __('حفظ') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Leave Team Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingLeavingTeam">
        <x-slot name="title">
            {{ __('اترك الفريق') }}
        </x-slot>

        <x-slot name="content">
            {{ __('هل أنت متأكد أنك تريد مغادرة هذا الفريق؟') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingLeavingTeam')" wire:loading.attr="disabled">
                {{ __('لا') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="leaveTeam" wire:loading.attr="disabled">
                {{ __('غادر') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <!-- Remove Team Member Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingTeamMemberRemoval">
        <x-slot name="title">
            {{ __('إزالة عضو الفريق') }}
        </x-slot>

        <x-slot name="content">
            {{ __('هل أنت متأكد أنك تريد إزالة هذا الشخص من الفريق؟') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingTeamMemberRemoval')" wire:loading.attr="disabled">
                {{ __('لا') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="removeTeamMember" wire:loading.attr="disabled">
                {{ __('إزالة') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
