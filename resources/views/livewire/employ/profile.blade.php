<div class="flex-grow min-h-full">

    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Starter</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="index.html" class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li class="text-xs text-default"> Pages
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li aria-current="page" class="text-xs text-gray-900">Starter</li>
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
           <form wire:submit.prevent="save">

    {{-- Basic Information --}}
    <div class="border-b mb-3 pb-3">
        <h6 class="mb-3">Basic Information</h6>

        {{-- First Name --}}
        <div class="mb-3">
            <label>First Name</label>
            <input type="text" wire:model="first_name" class="form-control">
            @error('first_name') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Last Name --}}
        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" wire:model="last_name" class="form-control">
            @error('last_name') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label>Email</label>
            <input type="email" wire:model="email" class="form-control">
            @error('email') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Phone Number --}}
        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" wire:model="contact_number" class="form-control">
            @error('contact_number') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- local_address --}}
        <div class="mb-3">
            <label>local_address</label>
            <input type="text" wire:model="local_address" class="form-control">
            @error('local_address') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Photo --}}
        <div class="mb-3">
            <label>Profile Photo</label>
            <input type="file" wire:model="photo" class="form-control">
            @error('photo') <span class="text-danger text-sm">{{ $message }}</span> @enderror
             {{-- Preview --}}
            @if (!empty(Auth::guard('employee')->user()->photo))
                <div class="mt-2">
                    <img src="{{ customAsset(Auth::guard('employee')->user()->photo,true,'user') }}" width="80">
                </div>
            @endif
            @if ($photo)
                <div class="mt-2">
                    <img src="{{ $photo->temporaryUrl() }}" width="80">
                </div>
            @endif
           
        </div>
    </div>

    {{-- Change Password --}}
    <div class="border-b mb-3 pb-3">
        <h6 class="mb-3">Change Password</h6>

        {{-- New Password --}}
        <div class="mb-3">
            <label>New Password</label>
            <input type="password" wire:model="password" class="form-control">
            @error('password') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" wire:model="password_confirmation" class="form-control">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

        </div>
    </div>
</div>
