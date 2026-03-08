<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Manage Roles</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li class="text-xs text-default">
                        Roles
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.role.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-plus me-2"></i>Create Role
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <div class="flex items-center justify-between">
                    <h5 class="card-title">Roles List</h5>
                    <div class="my-xl-auto right-content grid grid-cols-1 ">
                        <div class="">
                            <x-form.input name="search" placeholder="Search here .." :live="true" />
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-borderColor">
                            <tr>
                                <th
                                    class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th
                                    class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role Name
                                </th>
                                <th
                                    class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Users Count
                                </th>
                                <th
                                    class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Default Role
                                </th>
                                <th
                                    class="px-5 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created Date
                                </th>
                                <th
                                    class="px-5 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-borderColor">
                            @forelse ($roles as $index => $role)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $roles->firstItem() + $index }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $role->name }}</div>
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $role->users_count }} {{ Str::plural('user', $role->users_count) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        @if ($role->is_default)
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Yes
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                No
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $role->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if (!$role->is_default)
                                            <a href="{{ route('admin.role.edit', $role->id) }}"
                                                class="text-primary hover:text-primary-900 mr-3">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        @endif


                                        @if (!$role->is_default && $role->users->count() == 0)
                                            <button wire:click="deleteRole({{ $role->id }})"
                                                wire:confirm="Are you sure you want to delete this role?"
                                                class="text-danger hover:text-red-900">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-4 text-center text-sm text-gray-500">
                                        No roles found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($roles->hasPages())
                <div class="card-footer p-5 border-t border-borderColor">
                    {{ $roles->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
