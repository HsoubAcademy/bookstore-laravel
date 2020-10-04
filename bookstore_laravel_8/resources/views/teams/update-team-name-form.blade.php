<x-jet-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('اسم الفريق') }}
    </x-slot>

    <x-slot name="description">
        {{ __('اسم الفريق ومعلومات المالك.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-jet-label value="{{ __('صاحب الفريق') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover ml-2" src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div>{{ $team->owner->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('اسم الفريق') }}" />

            <x-jet-input id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model.defer="state.name"
                        :disabled="! Gate::check('update', $team)" />

            <x-jet-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('تم الحفظ.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('حفظ') }}
            </x-jet-button>
        </x-slot>
    @endif
</x-jet-form-section>
