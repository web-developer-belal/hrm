<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Device Management</h2>
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
                    <li class="text-xs text-default">Device Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <button wire:click="addDevice"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Add Device</button>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Device List</h5>

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
                                Ip Address</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Port</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($devices as $device)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                  {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $device->name }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $device->ip_address }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $device->port }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $device->status ==1 ?'Active':'Inactive' }}</td>



                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        <button href="" wire:click="sync({{ $device->id }})"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-eye"></i>Sync Now</button>
                                                <div wire:loading>
                                                    Data Sync ..........
                                                </div>
                                        <button href="" wire:click="addDevice({{ $device->id }})"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- /Employees List -->

    @if($Modalshow)
<div  class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out modal p-4 flex" data-select2-id="select2-data-add_bank_satutory" aria-modal="true" role="dialog">
			<div class="relative p-4 w-full max-w-[800px] max-h-full" data-select2-id="select2-data-32-9dal">
				<div class="relative bg-white rounded-defaultradius">
					<div class="flex items-center justify-between p-4 border-b border-borderColor">
						<h4 class="font-semibold">Add New Device</h4>

						<button type="button" class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center" data-modal-hide="add_bank_satutory">
							<i class="ti ti-x" wire:click="closeModal"></i>
							<span class="sr-only">Close modal</span>
						</button>
					</div>
					<form wire:submit="saveDeviceIP">
						<div class="p-4">
							<div class="border-b mb-4">


								<div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

									<div class="md:col-span-6">
										<div class="mb-3">
											<x-form.input
                                            label="Device Name"
                                            name="name"
                                            :is_required="false"
                                            :error="true"
                                            placeholder="Enter Device Name" />
                                        </div>
									</div>

									<div class="md:col-span-6">
										<div class="mb-3">
											<x-form.input
                                            label="Ip Address"
                                            name="ip_address"
                                            :is_required="true"
                                            :error="true"
                                            placeholder="192.168.0.143" />
                                        </div>
									</div>
									<div class="md:col-span-6">
										<div class="mb-3">
											<x-form.input
                                            label="Port"
                                            name="port"
                                            :is_required="false"
                                            :error="true"
                                            placeholder="473" />
                                        </div>
									</div>

										<div class="md:col-span-6">
                                            <div class="mb-3">
                                                 <!-- Status -->
                                                 <x-form.select label="Status" name="status" :is_required="true" :error="true"
                                                 :options="[' ' => 'Select Status', '0' => 'Inactive', '1'=> 'Active']" />


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
