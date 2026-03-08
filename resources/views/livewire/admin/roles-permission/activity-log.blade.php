<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Activity Logs</h2>
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
                    <li class="text-xs text-default">Activity Logs</li>

                </ol>
            </nav>
        </div>
       
    </div>
    <!-- /Breadcrumb -->

    <!-- Activity Logs List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Activity Logs</h5>

            <div class="flex my-xl-auto right-content items-center flex-wrap gap-3">
                <div class="me-3">
                    <x-form.input name="search" placeholder="Search subject, values, route, user..." :live="true" />
                </div>
                <div class="me-3">
                    <x-form.select name="user" placeholder="All users" :live="true" :options="$users" />
                </div>
                <div class="me-3">
                    <x-form.select name="event" placeholder="All events" :live="true" :options="$events" />
                </div>
                <div class="me-3">
                    <x-form.select name="perPage" placeholder="Show per page" :live="true" :options="[
                        10 => '10 per page',
                        25 => '25 per page',
                        50 => '50 per page',
                        100 => '100 per page',
                    ]" />
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
                                User</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Event</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Subject</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Details</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Route / URL</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Date</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor" wire:loading.class="opacity-50">
                        @foreach ($logs as $log)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ ($logs->currentPage() - 1) * $logs->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 font-medium p-3">
                                    <div class="ms-2">
                                        <h6 class="font-medium text-gray-900">{{ $log->user?->full_name ?? 'System' }}</h6>
                                        <span class="text-xs leading-normal">{{ $log->user?->email ?? '-' }}</span>
                                    </div>
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <span class="bg-success-100 text-success rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs">
                                        <i class="ti ti-point-filled me-1"></i>{{ ucfirst(str_replace('_', ' ', $log->event)) }}
                                    </span>
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <div class="text-sm text-gray-900">{{ \Illuminate\Support\Str::afterLast($log->subject_type ?? '-', '\\') }}</div>
                                    <div class="text-xs text-gray-500">#{{ $log->subject_id ?? '-' }}</div>
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <div class="text-sm text-gray-900">{{ $log->description ?? '-' }}</div>
                                    @if ($log->event === 'updated' && is_array($log->new_values) && count($log->new_values))
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ implode(', ', collect($log->new_values)->keys()->take(4)->map(fn($item) => \Illuminate\Support\Str::headline($item))->toArray()) }}
                                            @if (count($log->new_values) > 4)
                                                ...
                                            @endif
                                        </div>
                                    @elseif(is_array($log->new_values) && count($log->new_values))
                                        <div class="text-xs text-gray-500 mt-1">New: {{ \Illuminate\Support\Str::limit(json_encode($log->new_values), 80) }}</div>
                                    @elseif(is_array($log->old_values) && count($log->old_values))
                                        <div class="text-xs text-gray-500 mt-1">Old: {{ \Illuminate\Support\Str::limit(json_encode($log->old_values), 80) }}</div>
                                    @endif
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <div class="text-xs text-gray-900">{{ $log->route_name ?: '-' }}</div>
                                    <div class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($log->url ?? '-', 60) }}</div>
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3 text-xs">
                                    {{ $log->created_at?->format('d M Y h:i A') }}
                                </td>

                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        <button type="button" onclick="confirm('Delete this activity log?') || event.stopImmediatePropagation()"
                                            wire:click="deleteLog({{ $log->id }})"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i class="ti ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($logs->isEmpty())
                            <tr>
                                <td colspan="8" class="px-5 py-6 text-center text-gray-500">No activity logs found.</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        @if ($logs->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $logs->links() }}
            </div>
        @endif

    </div>
    <!-- /Activity Logs List -->
</div>
