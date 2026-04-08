<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Attendance Reports</h2>
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
                    <li class="text-xs text-default">Attendance Reports</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap gap-2">

            <div class="mb-2">
                <button wire:click="processRunningMonth"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-refresh me-2"></i>Attendance Sync</button>

                <span wire:loading wire:target="processRunningMonth">Processing...</span>
            </div>
            <div class="mb-2">
                <a href="{{ route('admin.rosters.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Add Attendance</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Attendance List</h5>

            <div class="flex my-xl-auto right-content items-center flex-wrap gap-3">
                <div class="me-3">
                    <x-form.date-range-picker :startDate="$startDate" :endDate="$endDate" />
                </div>
                <div class="me-3">
                    <x-form.input name="search" placeholder="Search employee" :live="true" />
                </div>
                <div class="me-3">
                    <x-form.select name="branches" placeholder="Select branch" :live="true" :options="$branches_options"
                        :isMultiple="true" :search="true" />
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
                                Employee</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Check IN</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Check Out</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Late</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Early Exit</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Over Times</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor" wire:loading.class="opacity-50">
                        @foreach ($attendancelist as $attendance)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 font-medium p-3">
                                    <div class="flex items-center file-name-icon">
                                        <a href="#" class="size-8 rounded-full border border-borderColor">
                                            <img src="{{ customAsset($attendance->employee->photo, true, 'user') }}"
                                                class="rounded-full size-8 img-fluid" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="font-medium"><a
                                                    href="{{ route('admin.employees.details', ['emp' => $attendance->id]) }}"
                                                    class="text-gray-900 hover:text-primary">{{ $attendance->employee->full_name }}</a>
                                            </h6>
                                            <span
                                                class="text-xs leading-normal">{{ $attendance->employee->designation->name }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <span
                                        class="bg-success-100 text-success rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs">
                                        <i class="ti ti-point-filled me-1"></i>{{ ucFirst($attendance->status) }}
                                    </span>
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    {{-- {{ $attendance->clock_in->format('h:i A') ?? '' }} --}}
                                    {{ $attendance?->clock_in?->format('h:i A') ?? '' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    {{ $attendance->clock_out?->format('h:i A') ?? '' }}</td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    {{ formatDuration(gmdate('H:i:s', $attendance->late_minutes * 60)) }}

                                  
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                  
                                    {{ formatDuration(gmdate('H:i:s', $attendance->early_exit_minutes * 60)) }}
                                 
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    {{ formatDuration(gmdate('H:i:s', $attendance->overtime_minutes * 60)) }}
                                  
                                </td>

                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        {{-- <a href="{{ route('admin.attendance.edit',['emp'=>$attendance->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></a> --}}
                                        <button type="button" wire:click="deleteAttendance({{ $attendance->id }})"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i class="ti ti-trash"></i></button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @if ($attendancelist->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $attendancelist->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->
</div>
