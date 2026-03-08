<div >
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">User Management</h2>
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
                    <li class="text-xs text-default">User Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap gap-2">
            
            <div class="mb-2">
                <a href="{{ route('admin.user.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Add User</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3 ">
            <h5>Users List</h5>
            <div class="my-xl-auto right-content grid grid-cols-1 ">
                <div class="">
                    <x-form.input name="search" placeholder="Search here .." :live="true" />
                </div>
                
            </div>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            
                            <th
                                class="no-sort text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor hover:outline-none">
                                SL
                            </th>
                            
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Employee info</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Role</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Permission</th>
                            
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($users as $user)
                            <tr class="even:bg-white dark:even-bg-white">
                                
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                
                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <div class="flex items-center file-name-icon">
                                        <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}"
                                            class="size-8 rounded-full border border-borderColor">
                                            <img src="{{ customAsset($user->photo, true, 'user', $user->first_name) }}"
                                                class="rounded-full size-8 img-fluid" alt="img">
                                        </a>
                                        <div class="ms-2 flex flex-col gap-1">
                                            <h6 class="font-medium"><a
                                                    href="{{ route('admin.user.edit', ['user' => $user->id]) }}"
                                                    class="text-gray-900 hover:text-primary">{{ $user->full_name }}</a>
                                            </h6>
                                            <span class="text-xs leading-normal"> {{ $user->email }}</span>
                                            <span class="text-xs leading-normal"> {{ $user->phone_number }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $user->role }}
                                </td>

                                <td class="px-5 py-2.5 text-gray-500">
                                    {!! $user->role=='admin' ? 'All Permissions Granted' : $user->permissions->pluck('name')->join(', ') !!}
                                </td>

                                <td class="px-5 py-2.5 text-gray-500">

                                    <span wire:click="statusToggle({{ $user->id }})"
                                        class="bg-{{ $user->status == 'active' ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer">
                                        <i class="ti ti-point-filled me-1">
                                            {{ $user->status == 'active' ? 'Active' : 'Deactive' }}</i>
                                    </span>

                                </td>


                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></a>
                                      
                                        <button wire:click="deleteUser({{ $user->id }})"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
        @if ($users->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $users->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->
</div>
