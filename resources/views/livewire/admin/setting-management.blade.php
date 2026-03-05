<div x-data="{ activeTab: 'company', deviceForm: false }" 
     x-init="$watch('activeTab', value => { if(value === 'zkteco') { activeTab = 'zkteco.devices' } })"
     @deviceFormClose.window="deviceForm = false"
     @deviceFormOpen.window="deviceForm = true">
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Settings</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li><span class="text-default">/</span></li>
                    <li aria-current="page" class="text-xs text-gray-900">Settings</li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mb-4 rounded bg-green-100 px-4 py-2 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-4 gap-y-4 gap-x-6">
        <div class="xl:col-span-1">
            <div class="bg-white rounded shadow p-4">
                <div class="flex flex-col gap-1">
                    <button type="button" @click="activeTab = 'company'" class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'company' ? 'bg-primary-transparent text-primary' :
                            'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'company'"></i>Company Settings
                    </button>

                    <button type="button" @click="activeTab = 'logo'" class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'logo' ? 'bg-primary-transparent text-primary' :
                            'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'logo'"></i>Logo & Visual
                    </button>

                    {{-- <button type="button" @click="activeTab = 'system'"
                        class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'system' ? 'bg-primary-transparent text-primary' : 'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'system'"></i>System Settings
                    </button> --}}

                    <button type="button" @click="activeTab = 'smtp'" class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'smtp' ? 'bg-primary-transparent text-primary' :
                            'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'smtp'"></i>Email (SMTP) Settings
                    </button>

                    <button type="button" @click="activeTab = 'zkteco.devices'" class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'zkteco' || activeTab === 'zkteco.devices' || activeTab === 'zkteco.sync_history' ? 'bg-primary-transparent text-primary' :
                            'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'zkteco' || activeTab === 'zkteco.devices' || activeTab === 'zkteco.sync_history'"></i>ZKTeco (Biometric)
                    </button>

                    {{-- <button type="button" @click="activeTab = 'cache'"
                        class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'cache' ? 'bg-primary-transparent text-primary' : 'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'cache'"></i>Cache Settings
                    </button> --}}
                </div>
            </div>
        </div>

        <div class="xl:col-span-3">
            <div class="bg-white rounded shadow p-6" x-show="activeTab === 'company'" x-cloak>
                <div class="border-b pb-3 mb-4">
                    <h4 class="text-lg font-bold">Company Information</h4>
                </div>

                <form wire:submit.prevent="saveCompanySettings" class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <x-form.input type="text" label="Company Name" placeholder="Enter company name"
                            name="company_name" :isRequired="true" :error="true" />
                        <x-form.input type="tel" label="Phone Number" placeholder="Enter phone number"
                            name="phone_number" :error="true" />
                        <x-form.input type="tel" label="Alternative Phone Number"
                            placeholder="Enter alternative phone" name="alternative_phone_number" :error="true" />
                        <x-form.input type="email" label="Email Address" placeholder="Enter email address"
                            name="email_address" :error="true" />
                        <x-form.input type="url" label="Website URL" placeholder="https://example.com"
                            name="website_url" :error="true" />
                    </div>

                    <x-form.textarea label="Company Address" name="company_address" rows="3" :error="true"
                        placeholder="Enter company address" />

                    <div class="flex items-center justify-end">
                        <x-form.button type="submit" text="Save Changes" />
                    </div>
                </form>
            </div>

            <div class="bg-white rounded shadow p-6" x-show="activeTab === 'logo'" x-cloak>
                <div class="border-b pb-3 mb-4">
                    <h4 class="text-lg font-bold">Logo & Visual Settings</h4>
                </div>

                <form wire:submit.prevent="saveCompanySettings">
                    <x-form.file-upload name="company_logo" label="Company Logo" accept="image/*" :oldFiles="customAsset($company_logo_path)"
                        :fullPreview="true" />
                    <x-form.file-upload name="favicon" label="Favicon Upload"
                        accept="image/x-icon,image/png,image/svg+xml" :oldFiles="customAsset($favicon_path)" :fullPreview="true" />

                    <div class="flex items-center justify-end mt-4">
                        <x-form.button type="submit" text="Save Changes" />
                    </div>
                </form>
            </div>

            <div class="bg-white rounded shadow p-6" x-show="activeTab === 'system'" x-cloak>
                <div class="border-b pb-3 mb-4">
                    <h4 class="text-lg font-bold">System Settings</h4>
                </div>

                <form wire:submit.prevent="saveSystemSettings" class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <x-form.select label="System Language" name="system_language" :options="['en' => 'English']"
                            :error="true" />
                        <x-form.select label="Date Format" name="date_format" :options="[
                            'Y-m-d' => 'Y-m-d (2025-01-01)',
                            'd-m-Y' => 'd-m-Y (01-01-2025)',
                            'm/d/Y' => 'm/d/Y (01/01/2025)',
                        ]" :error="true" />
                        <x-form.select label="Time Format" name="time_format" :options="['H:i' => 'H:i (13:30)', 'h:i A' => 'h:i A (01:30 PM)']" :error="true" />
                        <x-form.select label="Time Zone" name="time_zone" :options="['UTC' => 'UTC', 'Asia/Dhaka' => 'Asia/Dhaka', 'Asia/Kolkata' => 'Asia/Kolkata']" :error="true" />
                        <x-form.select label="IP Address Restrictions" name="enable_ip_restriction" :options="['0' => 'Disable', '1' => 'Enable']"
                            :error="true" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-form.button type="submit" text="Save Changes" />
                    </div>
                </form>
            </div>

            <div class="bg-white rounded shadow p-6" x-show="activeTab === 'smtp'" x-cloak>
                <div class="border-b pb-3 mb-4">
                    <h4 class="text-lg font-bold">Email (SMTP) Settings</h4>
                    <p class="text-xs text-gray-500 mt-1">These values are stored directly in .env.</p>
                </div>

                <form wire:submit.prevent="saveSmtpSettings" class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <x-form.input label="Mail Driver" name="mail_driver" :error="true" placeholder="smtp" />
                        <x-form.input label="SMTP Host" name="smtp_host" :error="true"
                            placeholder="smtp.mailtrap.io" />
                        <x-form.input label="SMTP Port" name="smtp_port" :error="true" type="number"
                            placeholder="587" />
                        <x-form.input label="Username" name="smtp_username" :error="true" />
                        <x-form.input label="Password" name="smtp_password" :error="true" type="password" />
                        <x-form.select label="Encryption Type" name="smtp_encryption" :options="['tls' => 'TLS', 'ssl' => 'SSL']"
                            :error="true" />
                        <x-form.input type="email" label="From Email Address" name="smtp_from_email"
                            :error="true" />
                        <x-form.input label="From Name" name="smtp_from_name" :error="true" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-form.button type="submit" text="Save Changes" />
                    </div>
                </form>
            </div>

            <div class="bg-white rounded shadow p-6" x-show="activeTab === 'zkteco' || activeTab === 'zkteco.devices' || activeTab === 'zkteco.sync_history'" x-cloak>
                <div class="border-b pb-3 mb-4">
                    <h4 class="text-lg font-bold">ZKTeco (Biometric) Settings</h4>
                </div>

                <!-- Sub Navigation -->
                <div class="flex gap-2 mb-4">
                    <button type="button" @click="activeTab = 'zkteco.sync_history'" 
                        class="px-4 py-2 rounded text-sm font-medium"
                        :class="activeTab === 'zkteco.sync_history' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'">
                        Sync History
                    </button>
                    
                    <button type="button" @click="activeTab = 'zkteco.devices'" 
                        class="px-4 py-2 rounded text-sm font-medium"
                        :class="activeTab === 'zkteco.devices' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'">
                        Devices
                    </button>
                </div>

                <div x-show="activeTab === 'zkteco.sync_history'" x-cloak>
                    <div class="overflow-x-auto">
                        <table class="table w-full border-b border-borderColor">
                            <thead class="thead-light">
                                <tr>
                                    <th
                                        class="no-sort text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor hover:outline-none">
                                        SL
                                    </th>

                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Device</th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Total Logs</th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Status</th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Started
                                    </th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Completed
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-borderColor">
                                @forelse ($syncHistory as $history)
                                    <tr class="even:bg-white dark:even-bg-white">
                                        <td class="px-5 py-2.5 text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-5 py-2.5 text-gray-900">{{ $history->device->name }}</td>
                                        <td class="px-5 py-2.5 text-gray-900">{{ $history->total_logs }}</td>
                                        <td class="px-5 py-2.5 text-gray-900">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                @if($history->status == 'success') bg-green-100 text-green-700
                                                @elseif($history->status == 'processing') bg-blue-100 text-blue-700
                                                @elseif($history->status == 'failed') bg-red-100 text-red-700
                                                @endif">
                                                {{ ucfirst($history->status) }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-2.5 text-gray-900">{{ $history->sync_started_at }}</td>
                                        <td class="px-5 py-2.5 text-gray-900">{{ $history->sync_completed_at ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-5 py-4 text-center text-gray-500">
                                            No sync history available.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($syncHistory->hasPages())
                        <div class="mt-4">
                            {{ $syncHistory->links() }}
                        </div>
                    @endif
                </div>

                <div x-show="activeTab === 'zkteco.devices'" x-cloak>
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-md font-semibold">Device List</h5>
                        <button type="button" @click="deviceForm = !deviceForm; if(deviceForm) { $wire.call('resetDeviceForm') }" 
                            class="btn bg-primary text-white hover:bg-primary-900 px-4 py-2 rounded">
                            <i class="ti ti-plus mr-1" x-show="!deviceForm"></i>
                            <i class="ti ti-x mr-1" x-show="deviceForm"></i>
                            <span x-text="deviceForm ? 'Cancel' : 'Add Device'"></span>
                        </button>
                    </div>

                    <!-- Device Form -->
                    <div x-show="deviceForm" x-cloak class="mb-6">
                        <form wire:submit="saveDeviceIP" class="bg-gray-50 rounded border border-gray-200 p-4">
                            <div class="border-b pb-3 mb-4">
                                <h5 class="text-md font-semibold">Device Information</h5>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-form.input label="Device Name" name="name" :isRequired="true"
                                        :error="true" placeholder="Enter Device Name" />
                                </div>

                                <div>
                                    <x-form.input label="IP Address" name="ip_address" :isRequired="true"
                                        :error="true" placeholder="192.168.0.143" />
                                </div>

                                <div>
                                    <x-form.input label="Port" name="port" :isRequired="false"
                                        :error="true" placeholder="4730" />
                                </div>

                                <div>
                                    <x-form.select label="Status" name="status" :isRequired="true"
                                        :error="true" :options="['' => 'Select Status', '0' => 'Inactive', '1' => 'Active']" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-2 mt-4 pt-4 border-t border-gray-200">
                                <button type="button" @click="deviceForm = false"
                                    class="btn bg-light border border-light text-gray-900 hover:bg-light-900 font-medium px-4 py-2">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="btn bg-primary border border-primary text-white hover:bg-primary-900 font-medium px-4 py-2"
                                    wire:loading.attr="disabled" wire:target="saveDeviceIP">
                                    <span wire:loading.remove wire:target="saveDeviceIP">Save Device</span>
                                    <span wire:loading wire:target="saveDeviceIP">
                                        <i class="ti ti-loader animate-spin"></i> Saving...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Devices Table -->
                    <div class="overflow-x-auto">
                        <table class="table w-full border-b border-borderColor">
                            <thead class="thead-light">
                                <tr>
                                    <th
                                        class="no-sort text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor hover:outline-none">
                                        SL
                                    </th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Name</th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        IP Address</th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Port</th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Status
                                    </th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-borderColor">
                                @forelse ($devices as $device)
                                    <tr class="even:bg-white dark:even-bg-white">
                                        <td class="px-5 py-2.5 text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-5 py-2.5 text-gray-900">{{ $device->name }}</td>
                                        <td class="px-5 py-2.5 text-gray-900">{{ $device->ip_address }}</td>
                                        <td class="px-5 py-2.5 text-gray-900">{{ $device->port }}</td>
                                        <td class="px-5 py-2.5 text-gray-900">
                                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $device->status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $device->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-2.5 text-gray-500">
                                            <div class="flex items-center gap-2">
                                                <button wire:click="sync({{ $device->id }})"
                                                    class="flex items-center gap-1 px-3 py-1.5 text-sm rounded-[5px] bg-blue-100 text-blue-700 hover:bg-blue-200"
                                                    wire:loading.attr="disabled" wire:target="sync({{ $device->id }})">
                                                    <span wire:loading.remove wire:target="sync({{ $device->id }})">
                                                        <i class="ti ti-refresh"></i> Sync Now
                                                    </span>
                                                    <span wire:loading wire:target="sync({{ $device->id }})">
                                                        <i class="ti ti-loader animate-spin"></i> Syncing...
                                                    </span>
                                                </button>
                                                
                                                <button wire:click="addDevice({{ $device->id }})"
                                                    class="size-[30px] flex items-center justify-center rounded-[5px] hover:bg-gray-100 text-gray-700"
                                                    title="Edit Device">
                                                    <i class="ti ti-edit"></i>
                                                </button>
                                                
                                                <button wire:click="deleteDevice({{ $device->id }})"
                                                    wire:confirm="Are you sure you want to delete this device?"
                                                    class="size-[30px] flex items-center justify-center rounded-[5px] hover:bg-red-100 text-red-700"
                                                    title="Delete Device">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-5 py-4 text-center text-gray-500">
                                            No devices found. Click "Add Device" to create one.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded shadow p-6" x-show="activeTab === 'cache'" x-cloak>
                <div class="border-b pb-3 mb-4">
                    <h4 class="text-lg font-bold">Cache Settings</h4>
                </div>

                <div class="space-y-4">
                    <div class="rounded border border-borderColor p-4">
                        <p class="text-sm text-gray-600">View Current Cache Size</p>
                        <h3 class="text-xl font-semibold mt-1">{{ $cacheSize }}</h3>
                    </div>

                    <div class="rounded border border-borderColor p-4">
                        <p class="text-sm text-gray-600 mb-2">Cache Clear Includes:</p>
                        <ul class="list-none ml-5 text-sm text-gray-700 space-y-1">
                            <li>Application Cache</li>
                            <li>Route Cache</li>
                            <li>View Cache</li>
                            <li>Configuration Cache</li>
                        </ul>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="button" wire:click="clearCache" class="btn bg-danger text-white">
                            Clear Cache
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
