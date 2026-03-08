<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit User' : 'Create User' }}</h2>
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
                        {{ $isEditMode ? 'Edit User' : 'Create User' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.users') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-arrow-back-up me-2"></i>Users
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit User' : 'Create User' }}</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="saveUser" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <x-form.file-upload label="Photo" name="photo" :error="true" :oldFiles="$isEditMode && $user->photo ? [customAsset($user->photo)] : []"
                        :fullPreview="true" />

                    <x-form.input label="First Name" name="first_name" :isRequired="true" :error="true"
                        placeholder="Enter First Name" />

                    <x-form.input label="Last Name" name="last_name" :isRequired="false" :error="true"
                        placeholder="Enter Last Name" />
                    
                    <x-form.input label="Contact No" name="phone_number" :isRequired="true" :error="true"
                        placeholder="Enter Contact No" />
                    
                    <x-form.input label="Address" name="address" :isRequired="false" :error="true"
                        placeholder="Enter Address" />
                    
                    <x-form.input label="Email address" name="email" :isRequired="true" type="email"
                        :error="true" placeholder="Enter email address" />

                    <x-form.input label="Password" name="password" :isRequired="!$isEditMode" :error="true"
                        placeholder="Enter Password" type="password" />

                    <!-- Role Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Select Role <span class="text-danger">*</span>
                        </label>
                        <select wire:model="role_id"
                            class="form-control border border-borderColor rounded-[5px] px-3 py-2 text-sm w-full">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <x-form.select label="Status" name="status" :isRequired="true" :error="true"
                        :options="['active' => 'Active', 'inactive' => 'Inactive']" />

                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" :text="$isEditMode ? 'Update' : 'Submit'" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
