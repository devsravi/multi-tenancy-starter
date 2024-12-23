<x-tenant-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenants') }} <x-button-link href="{{ route('users.create') }}" class="ml-4 float-right" >Add User</x-button-link>
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
                                <th scope="col" class="px-6 py-3">Roles</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                     <td class="px-6 py-4">
                                        @foreach ($user->roles as $role)
                                            <span class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-full px-2 py-1 text-xs font-semibold mr-2">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        <x-button-link href="{{ route('users.edit', $user) }}" class="mr-2">Edit</x-button-link>
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
</x-tenant-app-layout>
