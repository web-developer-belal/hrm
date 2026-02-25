<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Device Sync HistoryManagement</h2>
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
                    <li class="text-xs text-default">Device Sync History Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <a href="{{route('admin.device.index')}}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Devices</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Device Sync History</h5>

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
                               Device</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Total Logs</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Started
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Completed
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                      @foreach($histories as $history)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                  {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $history->device->name }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $history->total_logs }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $history->status }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $history->sync_started_at }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $history->sync_completed_at }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- /Employees List -->

</div>
