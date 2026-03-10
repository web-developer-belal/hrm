<div x-data="{
    selectedOts: @entangle('selectedOts'),
    selectAll: false,
    toggleAll() {
        if (this.selectAll) {
            this.selectedOts = @json($ots->pluck('id')->toArray());
        } else {
            this.selectedOts = [];
        }
    }
}">
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">OT Management</h2>
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
                    <li class="text-xs text-default">OT Management</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap gap-2">
            <div class="mb-2">
                <a href="{{ route('admin.ot.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Add OT
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- OT List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>OT List</h5>
            <div class="my-xl-auto right-content grid grid-cols-1 md:grid-cols-4 gap-3">
                <div class="">
                    <x-form.input name="search" placeholder="Search OT name..." :live="true" />
                </div>
                <div class="">
                    <x-form.select name="branch_group_id" placeholder="Select Branch Group" 
                        :options="$branch_group_options" :live="true" />
                </div>
                <div class="">
                    <x-form.select name="rate_type" placeholder="Select Rate Type" :live="true"
                        :options="['fixed' => 'Fixed', 'percentage' => 'Percentage']" />
                </div>
                <div class="">
                    <x-form.select name="status" placeholder="Select Status" :live="true"
                        :options="['' => 'All', '1' => 'Active', '0' => 'Inactive']" />
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                SL
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                OT Name
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Branch Group
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Rate
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Rate Type
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Off Day Counting
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-borderColor">
                        @forelse ($ots as $ot)
                            <tr class="even:bg-white dark:even-bg-white hover:bg-gray-50">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ ($ots->currentPage() - 1) * $ots->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900 font-medium">
                                    {{ $ot->name }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $ot->group->name ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ number_format($ot->rate, 2) }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $ot->rate_type == 'fixed' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ ucfirst($ot->rate_type) }}
                                    </span>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <span class="inline-flex items-center">
                                        @if ($ot->off_day_counting)
                                            <i class="ti ti-check text-success text-lg"></i>
                                        @else
                                            <i class="ti ti-x text-danger text-lg"></i>
                                        @endif
                                    </span>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <span wire:click="statusToggle({{ $ot->id }})"
                                        class="bg-{{ $ot->status ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer hover:opacity-90 transition">
                                        <i class="ti ti-point-filled me-1"></i>
                                        {{ $ot->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.ot.edit', $ot->id) }}"
                                            class="inline-flex items-center justify-center size-8 rounded-full border border-borderColor hover:bg-primary hover:text-white transition"
                                            title="Edit">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                        <button wire:click="deleteOt({{ $ot->id }})" 
                                            wire:confirm="Are you sure you want to delete this OT?"
                                            class="inline-flex items-center justify-center size-8 rounded-full border border-borderColor hover:bg-danger hover:text-white transition"
                                            title="Delete">
                                            <i class="ti ti-trash text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-8 text-center text-gray-500">
                                    No OT records found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($ots->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $ots->links() }}
            </div>
        @endif
    </div>
    <!-- /OT List -->
</div>
