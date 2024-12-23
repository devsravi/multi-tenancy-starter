<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenants') }} <x-button-link href="{{ route('tenants.create') }}" class="ml-4 float-right" >Add Tenant</x-button-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-white-100">
                        <thead class="text-sm uppercase text-gray-700 bg-gray-50 dark:text-gray-700 dark:bg-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">S/N</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Domains</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($tenants as $tenant)
                                <tr>
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $tenant->name }}</td>
                                    <td class="px-6 py-4">{{ $tenant->email }}</td>
                                    <td class="px-6 py-4">
                                        @foreach ($tenant->domains as $domain)
                                            <span class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-full px-2 py-1 text-xs font-semibold mr-2"><a href="//{{$domain->domain }}" target="_blank" rel="noopener noreferrer nofollow">{{ $domain->domain }}</a></span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-button-link href="{{ route('tenants.edit', $tenant) }}" class="ml-4">Edit</x-button-link>
                                        <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="ms-4">
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
