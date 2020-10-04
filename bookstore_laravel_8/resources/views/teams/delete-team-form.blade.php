<x-jet-action-section>
    <x-slot name="title">
        {{ __('حذف الفريق') }}
    </x-slot>

    <x-slot name="description">
        {{ __('احذف هذا الفريق بشكل دائم') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('بمجرد حذف الفريق ، سيتم حذف جميع موارده وبياناته نهائيًا. قبل حذف هذا الفريق ، يرجى تنزيل أي بيانات أو معلومات بخصوص هذا الفريق ترغب في الاحتفاظ بها.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                {{ __('حذف الفريق') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete Team Confirmation Modal -->
        <x-jet-confirmation-modal wire:model="confirmingTeamDeletion">
            <x-slot name="title">
                {{ __('حذف الفريق') }}
            </x-slot>

            <x-slot name="content">
                {{ __('هل أنت متأكد أنك تريد حذف هذا الفريق؟ بمجرد حذف الفريق ، سيتم حذف جميع موارده وبياناته نهائيًا.') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                    {{ __('لا') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteTeam" wire:loading.attr="disabled">
                    {{ __('حذف الفريق') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </x-slot>
</x-jet-action-section>
