<div>

    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Employee Notice</h2>
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
                    <li class="text-xs text-default">Employee</li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li aria-current="page" class="text-xs text-gray-900">Notice</li>
                </ol>
            </nav>
        </div>

    </div>
    <!-- /Breadcrumb -->



    <!-- Employee Notice List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">

            <h5 class="me-2">Employee Notice</h5>
            <div class="flex my-xl-auto right-content items-center flex-wrap gap-3">
                <div class="me-3">
                    <div class="relative">
                        <input type="search" wire:model.live.debounce.500s='search'
                            class="block flex-1 border border-borderColor bg-white rounded-[5px] py-1.5 pl-2.5 pr-8 text-gray-900 placeholder:text-gray-400 focus:ring-0 focus:border-borderColor h-[38px] text-sm date-range"
                            placeholder="Search notice">

                    </div>
                </div>

            </div>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table  w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                SL</th>
                            <th
                                class="text-sm text-start leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Title</th>
                            <th
                                class="text-sm text-start leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Date</th>

                            <th
                                class="text-sm text-start leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($notices as $item)
                            <tr class="even:bg-white dark:even:bg-white">

                                {{-- Sl --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $notices->firstItem() + $loop->index }}
                                </td>
                                {{-- title --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->title }}
                                </td>

                                {{-- Date --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->created_at->format('d M Y') }}
                                </td>

                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">

                                        <a href="{{ route('employee.notices.view', ['notice' => $item->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-eye"></i></a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="py-4 px-3">

                {{ $notices->links() }}
            </div>
        </div>
    </div>
    <!-- /Employee Notice List -->

</div>
