<?php

use App\Models\Link;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.app')] class extends Component {
    use WithPagination;

    public Link $link;

    public function mount(Link $link): void
    {
        if (auth()->user()->id !== $link->user_id) {
            abort(403);
        }

        $this->link = $link;
        $this->link->load('visits');
    }

    public function with(): array
    {
        return [
            'visits' => $this->link->visits()->paginate(20),
        ];
    }
}; ?>


<div class="py-12">
    <div class="container mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 mb-8" role="alert">
                    <p class="text-sm">{{ session('message') }}</p>
                </div>
            @endif
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ $link->long_url }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ route('url', $link->short_url) }} - {{ $link->visits->count() }} {{ str()->plural('visit', $link->visits->count()) }}
                    </p>
                </header>

                @if ($link->visits->count() > 0)
                    <div class="relative overflow-x-auto my-8">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Ip Address</th>
                                    <th scope="col" class="px-6 py-3">Browser</th>
                                    <th scope="col" class="px-6 py-3">Platform</th>
                                    <th scope="col" class="px-6 py-3">Device</th>
                                    <th scope="col" class="px-6 py-3">Device Type</th>
                                    <th scope="col" class="px-6 py-3">Agent</th>
                                    <th scope="col" class="px-6 py-3">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visits as $visit)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4">{{ $visit->ip_address }}</td>
                                        <td class="px-6 py-4">{{ $visit->browser }}</td>
                                        <td class="px-6 py-4">{{ $visit->platform }}</td>
                                        <td class="px-6 py-4">{{ $visit->device }}</td>
                                        <td class="px-6 py-4">{{ $visit->device_type }}</td>
                                        <td class="px-6 py-4 max-w-48">{{ $visit->agent }}</td>
                                        <td class="px-6 py-4">{{ $visit->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-4">
                        {{ $visits->links() }}
                    </div>
                @endif
            </section>
        </div>
    </div>
</div>