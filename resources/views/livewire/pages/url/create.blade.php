<?php

use App\Actions\Links\CreateLink;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public string $url = '';

    public function saveLink(CreateLink $action): void
    {
        $validated = $this->validate([
            'url' => ['required', 'string', 'url', 'max:255'],
        ]);

        $shortUrl = $action->handle($validated['url']);

        session()->flash('message', 'URL created successfully');
        $this->redirectRoute('url.view', $shortUrl);
    }
}; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Create a new short URL') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Use this form to create a new short URL.') }}
                        </p>
                    </header>

                    <form wire:submit="saveLink" class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="url" :value="__('URL')" />
                            <x-text-input wire:model="url" id="url" name="url" type="text" class="mt-1 block w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('url')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>