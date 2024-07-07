<x-app-layout>
    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                           {{ __('Dashboard') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Click on the links below to see the details of each short URL.') }}
                        </p>
                    </header>

                    @if ($links->count() > 0)
                        <div class="relative overflow-x-auto my-8">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Original URL</th>
                                        <th scope="col" class="px-6 py-3">Short URL</th>
                                        <th scope="col" class="px-6 py-3">Visits</th>
                                        <th scope="col" class="px-6 py-3">Created At</th>
                                        <th scope="col" class="px-6 py-3">Updated At</th>
                                        <th scope="col" class="px-6 py-3">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($links as $link)
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4">{{ $link->long_url }}</td>
                                            <td class="px-6 py-4">{{ route('url.view', $link->short_url) }}</td>
                                            <td class="px-6 py-4">{{ $link->visits->count() }}</td>
                                            <td class="px-6 py-4">{{ $link->created_at }}</td>
                                            <td class="px-6 py-4">{{ $link->updated_at }}</td>
                                            <td class="px-6 py-4"><a class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" href="{{ route('url.view', $link->short_url) }}">Details</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="my-4">
                            {{ $links->links() }}
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
