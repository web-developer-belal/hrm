<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Leave Management</h2>
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
                    <li class="text-xs text-default">Leave Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <a href="{{ route('admin.leavemgt.leave.application') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Add Leave Application</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Leave List</h5>

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
											Name</th>
                          <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
											Leave Type </th>
										<th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
											From</th>

										<th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
											To</th>
										<th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
											No of Days</th>
										<th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
											Status</th>
                                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                                Approved By </th>
										<th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                            Action
										</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($leaves as $leave)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $leave->employee->first_name }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $leave->type->name }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $leave->from_date }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $leave->to_date }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $leave->total_days }}</td>




                                {{-- <td class="px-5 py-2.5 text-gray-500">

                                    <span"
                                        class="bg-{{ $leave->status === 'approved' ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer">
                                        <i class="ti ti-point-filled me-1"></i>{{ ucfirst($leave->status) }}
                                    </span>

                                </td> --}}
                               <td class="px-5 py-2.5 text-gray-500 p-3">
											<div>
												<a href="javascript:void(0);" class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900" data-dropdown-toggle="designation-dropdown-{{ $leave->id }}">
													<span class="rounded-full bg-transparent-success flex justify-center items-center me-2"><i class="ti ti-point-filled bg-success-100 rounded-full text-success me-1"></i>
													{{ucfirst($leave->status)}}<i class="ti ti-chevron-down ml-1"></i>
												</span></a>
												<ul id="designation-dropdown-{{ $leave->id }}" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1597px, 398px);">
												<li>
													<a href="javascript:void(0);"  wire:click="statusChange({{ $leave->id }}, 'approved')"  class="rounded p-2 flex items-center hover:bg-primary-100 hover:text-primary">Approved</a>
												</li>
												<li>
													<a href="javascript:void(0);" wire:click="statusChange({{ $leave->id }},'rejected')" class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
												</li>
												<li>
													<a href="javascript:void(0);" wire:click="statusChange({{ $leave->id }},'pending')"  class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Pending</a>
												</li>

											</ul>
											</div>
										</td>
                                        <td class="px-5 py-2.5 text-gray-500">{{ $leave->approved_by }}</td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        {{-- <a href=""
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></a> --}}
                                        <button type="button"
    wire:click="deleteLeave({{ $leave->id }})"
    wire:confirm="Are you sure you want to delete this leave?"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                            ><i
                                                class="ti ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @if ($leaves->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $leaves->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->
</div>
