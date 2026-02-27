<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Designation Management</h2>
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
                    <li class="text-xs text-default">Designation Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <a href="{{ route('admin.designations.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Add Designation</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Designation List</h5>

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
                               Designation Name</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Department</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Description</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($designations as $item)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $designations->firstItem() + $loop->index }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $item->name }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->department->name ?? 'N/A' }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->description }}</td>

                                <td class="px-5 py-2.5 text-gray-500">

                                    <span wire:click="toggleStatus({{ $item->id }})"
                                        class="bg-{{ $item->status === 'active' ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer">
                                        <i class="ti ti-point-filled me-1"></i>{{ ucfirst($item->status) }}
                                    </span>

                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        <a href="{{ route('admin.designations.edit', ['designation' => $item->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></a>
                                        <button wire:confirm="Are you sure to delete this designation?"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                            wire:click="deleteDesignation({{ $item->id }})"><i
                                                class="ti ti-trash"></i></button>
                                        <button wire:click="addOrUpdateSalary({{ $item->id }})"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                            "><i
                                                class="ti ti-eye"></i>Salary</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @if ($designations->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $designations->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->


    @if($salaryModalshow)
<div  class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out modal p-4 flex" data-select2-id="select2-data-add_bank_satutory" aria-modal="true" role="dialog">
			<div class="relative p-4 w-full max-w-[800px] max-h-full" data-select2-id="select2-data-32-9dal">
				<div class="relative bg-white rounded-defaultradius">
					<div class="flex items-center justify-between p-4 border-b border-borderColor">
						<h4 class="font-semibold">Salary Template</h4>
						<button type="button" class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center" data-modal-hide="add_bank_satutory">
							<i class="ti ti-x" wire:click="closeModal"></i>
							<span class="sr-only">Close modal</span>
						</button>
					</div>
					<form wire:submit="addOrUpdateSalarySubmit">
						<div class="p-4" data-select2-id="select2-data-30-25jf">
							<div class="border-b mb-4">
								<h5 class="mb-3">Salary Information (Addition)</h5>
								<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">


										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Salary basic</label>
											<input type="text" wire:model.live="basicSalary" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										         @error('basicSalary') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Percent %</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Fixed Amount</label>

										</div>
									</div>

								</div>
								<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">House Rent</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">
											<input type="text" wire:model.live="houseRentPercent"  class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('houseRentPercent') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">
											<input type="text" wire:model.live="houseRentAmount" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('houseRentAmount') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>

								</div>
								<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Medical Allowance</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="medicalAllowancePercent" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('medicalAllowancePercent') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="medicalAllowanceAmount" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('medicalAllowanceAmount') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>

								</div>
								<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Dear Allowance</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="dearAllowancePercent" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('dearAllowancePercent') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text"  wire:model.live="dearAllowanceAmout" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('dearAllowanceAmout') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>

								</div>
								<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Transport Allowance</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="transportAllowancePercent" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('transportAllowancePercent') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="transportAllowanceAmount" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('transportAllowanceAmount') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>

								</div>
								<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Provident Fund</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="pfEployerContributionPercent" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('pfEployerContributionPercent') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="pfEployerContributionAmount" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('pfEployerContributionAmount') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>

								</div>
								<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Other Allowance</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="otherAllowancePercent" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('otherAllowancePercent') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="otherAllowanceAmount" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">

                                         @error('otherAllowanceAmount') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>

								</div>
							</div>
							<div class="border-bottom mb-4">
								<h5 class="mb-3">Salary Deduction</h5>
								<div class="row mb-2">
                                    	<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">PF Employee Contributon</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="pfEmployeeContributionPercent" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">

                                         @error('pfEmployeeContributionPercent') <span>{{ $message }}</span> @enderror</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="pfEmployeeContributionAmount" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('pfEmployeeContributionAmount') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>

								</div>
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Welface Contributon</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="welfareContributionPercnet" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('welfareContributionPercnet') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="welfareContributionAmount" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('welfareContributionAmount') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>

								</div>
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-4">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Tax Deduction</label>

										</div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="taxDeductionPercent" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('taxDeductionPercent') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>
									<div class="md:col-span-4">
										<div class="mb-3">

											<input type="text" wire:model.live="taxDeductionAmount" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										 @error('taxDeductionAmount') <span>{{ $message }}</span> @enderror
                                        </div>
									</div>

								</div>



								</div>
							</div>
							<h5 class="mb-3">Total Salary</h5>
							<div class="row">
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Basic</label>
                                            <input type="text" readonly wire:model="basic_salary" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">House Rent</label>
                                            <input type="text" readonly wire:model="house_rent" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Med. Allow</label>
                                            <input type="text" readonly wire:model="medical_allowance" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Dear Allow.</label>
                                            <input type="text" readonly wire:model="dear_allowance" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">TA</label>
                                            <input type="text" readonly wire:model="transport_allowance" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">PF</label>
                                            <input type="text" readonly wire:model="pf_employer_contribution" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Other Allow</label>
                                            <input type="text" readonly wire:model="other_allowance" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">PF E (-)</label>
                                            <input type="text" readonly wire:model="pf_employee_contribution" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Welfare(-)</label>
                                            <input type="text" readonly wire:model="welfare_contribution" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Tax(-) </label>
                                            <input type="text" readonly wire:model="tax_deduction" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>
									<div class="md:col-span-2">
										<div class="mb-3">
											<label class="block mb-1 text-sm leading-normal font-medium text-title">Net Salary</label>
                                            <input type="text" readonly wire:model="totalSalary" class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
										</div>
									</div>


								</div>

							</div>
						</div>
						<div class="flex items-center justify-end p-4 border-t border-borderColor">
							<button data-modal-hide="add_bank_satutory" type="button" class="btn bg-light border border-light text-gray-900 text-center hover:bg-light-900 hover:text-gray-900 font-medium me-2" wire:click="closeModal">Cancel</button>
							<button type="submit" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-900 hover:text-white font-medium">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
    @endif
</div>
