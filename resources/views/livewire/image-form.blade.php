<form class="w-full" wire:submit.prevent="submit">
    {{ $this->form }}

    <x-primary-button type="submit" class="mt-6">
        Submit
    </x-primary-button>
</form>