<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Role' : 'Create Role' }}</h2>
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
                        {{ $isEditMode ? 'Edit Role' : 'Create Role' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.roles') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-arrow-back-up me-2"></i>Back to Roles
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit Role' : 'Create Role' }}</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="saveRole" class="space-y-4">

                    <!-- Role Name -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-form.input label="Role Name" name="name" :isRequired="true" :error="true"
                            placeholder="Enter role name (e.g., Manager, HR, etc.)" />
                    </div>

                    <!-- Permissions Section -->
                    <div class="border border-borderColor rounded-[5px] p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h6 class="font-medium text-gray-900">Role Permissions</h6>
                            <span class="text-xs text-gray-500">Select permissions for this role</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            @forelse ($permissionMatrix as $module => $actions)
                                <div class="border border-borderColor rounded-[5px] p-3">
                                    <h6 class="text-sm font-medium text-gray-900 mb-2">
                                        {{ \Illuminate\Support\Str::headline($module) }}
                                    </h6>
                                    <div class="space-y-2">
                                        @foreach ($actions as $action => $permission)
                                            <label class="inline-flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                <input type="checkbox" value="{{ $permission }}"
                                                    wire:model="selectedPermissions"
                                                    class="rounded border-borderColor text-primary focus:ring-primary" />
                                                <span>{{ ucfirst($action) }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="md:col-span-2 lg:col-span-3 text-sm text-gray-500">
                                    No permission routes found.
                                </div>
                            @endforelse
                        </div>

                        @error('selectedPermissions.*')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <x-form.button type="submit" :text="$isEditMode ? 'Update Role' : 'Create Role'" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
