<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Advanced Add Deduction Management</h2>
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
                    <li class="text-xs text-default">Advanced Add Deduction Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <a href="{{ route('admin.adjustment.new') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>New Advanced Add Deduction</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Roster List</h5>

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
                                Branch</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                               Name</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                               Amount</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                               Type</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                               Date</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($adjustments as $item)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                  {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->branch->name ?? 'N/A' }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $item->employee->first_name }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->amount ?? 'N/A' }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ ucfirst($item->type) ?? 'N/A' }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->date ?? 'N/A' }}</td>


                                <td class="px-5 py-2.5 text-gray-500">

                                    <span wire:click="toggleStatus({{ $item->id }})"
                                        class="bg-{{ $item->is_settled ===1 ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer">
                                        <i class="ti ti-point-filled me-1"></i>{{ $item->is_settled ===1 ? 'Settled' : 'Unsettled'  }}
                                    </span>

                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">

                                        @if($item->is_settled ==0)
                                        <a href="{{ route('admin.adjustment.edit', ['adjustment' => $item->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @if ($adjustments->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $adjustments->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->
</div>
