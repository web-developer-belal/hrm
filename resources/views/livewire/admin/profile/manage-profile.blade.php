<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Profile</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li class="text-xs text-default"> Dashboard
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li aria-current="page" class="text-xs text-gray-900">Profile</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="head-icons ml-2 mb-2">
                <a href="javascript:void(0);"
                    class="border flex items-center justify-center rounded bg-white w-9 h-9 hover:bg-primary hover:text-white hover:border-primary"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse"
                    id="collapse-header">
                    <i class="ti ti-chevrons-up"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-body p-5">
            <div class="border-b mb-3 pb-3">
                <h4 class="text-xl font-semibold">Profile</h4>
            </div>
            <form wire:submit.prevent="updateProfile">
                <div class="border-b mb-3 pb-3">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6">
                        <div class="md:col-span-12">
                            <h6 class="mb-3">Basic Information</h6>
                            <div class="flex items-center flex-wrap gap-2 bg-light w-full rounded-defaultradius p-4">
                                <div
                                    class="flex items-center justify-center size-20 rounded-full border border-dashed shrink-0 text-dark frames">
                                    <img src="{{ $photo ? $photo->temporaryUrl() : $photo_path }}" alt="Profile Photo" class="w-full h-full object-cover rounded-full">
                                </div>
                                <div class="profile-upload">
                                    <div class="mb-2">
                                        <h6 class="mb-1">Profile Photo</h6>
                                        <p class="text-xs leading-normal">Recommended image size is 40px x 40px</p>
                                    </div>
                                    <div class="profile-uploader d-flex items-center">
                                        <div
                                            class="drag-upload-btn btn bg-primary border border-primary text-white text-center hover:bg-primary-900 hover:text-white text-xs leading-normal relative py-1 px-2 me-2">
                                            Upload
                                            <input type="file" class="w-full h-full absolute top-0 left-0 opacity-0"
                                                wire:model="photo">
                                        </div>
                                        <a href="javascript:void(0);"
                                            class="btn bg-light border border-light text-gray-900 text-center hover:bg-light-900 hover:text-gray-900 text-xs leading-normal py-1 px-2">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-6 mt-3">
                            <x-form.input label="First Name" name="first_name" :isRequired="true" :error="true"
                                placeholder="Enter First Name" />
                        </div>
                        <div class="md:col-span-6 mt-3">
                            <x-form.input label="Last Name" name="last_name" :isRequired="true" :error="true"
                                placeholder="Enter Last Name" />
                        </div>
                        <div class="md:col-span-6 mt-3">
                            <x-form.input label="Email" name="email" :isRequired="true" :error="true"
                                placeholder="Enter Email" type="email" />
                        </div>
                        <div class="md:col-span-6 mt-3">
                            <x-form.input label="Phone" name="phone_number" :isRequired="false" :error="true"
                                placeholder="Enter Phone Number" type="tel" />
                        </div>
                        <div class="md:col-span-6 mt-3">
                            <x-form.input label="Address" name="address" :isRequired="false" :error="true"
                                placeholder="Enter Address" type="text" />
                        </div>

                    </div>
                </div>
                

                <div class="border-b mb-3 p-3">
                    <h6 class="mb-3">Change Password</h6>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6">
                        <div class="md:col-span-4 mt-4">
                            <x-form.input label="Old Password" name="old_password"  :error="true"
                                placeholder="Enter Old Password" type="password" />
                        </div>
                        <div class="md:col-span-4 mt-4">
                            <x-form.input label="New Password" name="new_password"  :error="true"
                                placeholder="Enter New Password" type="password" />
                        </div>
                        <div class="md:col-span-4 mt-4">
                            <x-form.input label="Confirm New Password" name="new_password_confirmation"  :error="true"
                                placeholder="Confirm New Password" type="password" />
                            
                        </div>
                    </div>
                </div>
                <div class="flex justify-end p-3">
                    <x-form.button type="submit" text="Save Changes" />
                </div>
            </form>
        </div>
    </div>
</div>
