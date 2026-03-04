<div x-data="{ activeTab: 'company' }">
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Settings</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
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
                    <button type="button" @click="activeTab = 'company'"
                        class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'company' ? 'bg-primary-transparent text-primary' : 'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'company'"></i>Company Settings 
                    </button>

                    <button type="button" @click="activeTab = 'logo'"
                        class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'logo' ? 'bg-primary-transparent text-primary' : 'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'logo'"></i>Logo & Visual
                    </button>

                    <button type="button" @click="activeTab = 'system'"
                        class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'system' ? 'bg-primary-transparent text-primary' : 'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'system'"></i>System Settings
                    </button>

                    <button type="button" @click="activeTab = 'smtp'"
                        class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'smtp' ? 'bg-primary-transparent text-primary' : 'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'smtp'"></i>Email (SMTP) Settings
                    </button>

                    <button type="button" @click="activeTab = 'zkteco'"
                        class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'zkteco' ? 'bg-primary-transparent text-primary' : 'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'zkteco'"></i>ZKTeco (Biometric)
                    </button>

                    <button type="button" @click="activeTab = 'cache'"
                        class="flex items-center rounded py-2 px-3"
                        :class="activeTab === 'cache' ? 'bg-primary-transparent text-primary' : 'hover:bg-primary-transparent hover:text-primary'">
                        <i class="ti ti-arrow-badge-right mr-2" x-show="activeTab === 'cache'"></i>Cache Settings
                    </button>
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
                        <x-form.input type="text" label="Company Name" placeholder="Enter company name" name="company_name" :isRequired="true" :error="true" />
                        <x-form.input type="tel" label="Phone Number" placeholder="Enter phone number" name="phone_number" :error="true" />
                        <x-form.input type="tel" label="Alternative Phone Number" placeholder="Enter alternative phone" name="alternative_phone_number" :error="true" />
                        <x-form.input type="email" label="Email Address" placeholder="Enter email address" name="email_address" :error="true" />
                        <x-form.input type="url" label="Website URL" placeholder="https://example.com" name="website_url" :error="true" />
                    </div>

                    <x-form.textarea label="Company Address" name="company_address" rows="3" :error="true" placeholder="Enter company address" />

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
                    <x-form.file-upload name="company_logo" label="Company Logo" accept="image/*" :oldFiles="customAsset($company_logo_path)" :fullPreview="true" />
                    <x-form.file-upload name="favicon" label="Favicon Upload" accept="image/x-icon,image/png,image/svg+xml" :oldFiles="customAsset($favicon_path)" :fullPreview="true" />

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
                        <x-form.select label="System Language" name="system_language" :options="['en' => 'English']" :error="true" />
                        <x-form.select label="Date Format" name="date_format" :options="['Y-m-d' => 'Y-m-d (2025-01-01)', 'd-m-Y' => 'd-m-Y (01-01-2025)', 'm/d/Y' => 'm/d/Y (01/01/2025)']" :error="true" />
                        <x-form.select label="Time Format" name="time_format" :options="['H:i' => 'H:i (13:30)', 'h:i A' => 'h:i A (01:30 PM)']" :error="true" />
                        <x-form.select label="Time Zone" name="time_zone" :options="['UTC' => 'UTC', 'Asia/Dhaka' => 'Asia/Dhaka', 'Asia/Kolkata' => 'Asia/Kolkata']" :error="true" />
                        <x-form.select label="IP Address Restrictions" name="enable_ip_restriction" :options="['0' => 'Disable', '1' => 'Enable']" :error="true" />
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
                        <x-form.input label="SMTP Host" name="smtp_host" :error="true" placeholder="smtp.mailtrap.io" />
                        <x-form.input label="SMTP Port" name="smtp_port" :error="true" type="number" placeholder="587" />
                        <x-form.input label="Username" name="smtp_username" :error="true" />
                        <x-form.input label="Password" name="smtp_password" :error="true" type="password" />
                        <x-form.select label="Encryption Type" name="smtp_encryption" :options="['tls' => 'TLS', 'ssl' => 'SSL']" :error="true" />
                        <x-form.input type="email" label="From Email Address" name="smtp_from_email" :error="true" />
                        <x-form.input label="From Name" name="smtp_from_name" :error="true" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-form.button type="submit" text="Save Changes" />
                    </div>
                </form>
            </div>

            <div class="bg-white rounded shadow p-6" x-show="activeTab === 'zkteco'" x-cloak>
                <div class="border-b pb-3 mb-4">
                    <h4 class="text-lg font-bold">ZKTeco (Biometric) Settings</h4>
                    <p class="text-xs text-gray-500 mt-1">These values are stored directly in .env.</p>
                </div>

                <form wire:submit.prevent="saveZktecoSettings" class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <x-form.input type="url" label="ZKTeco Device URL" name="zkteco_device_url" :error="true" placeholder="http://110.78.xxx.xxx:8080" />
                        <x-form.input type="text" label="API Username" name="zkteco_api_username" :error="true" />
                        <x-form.input type="password" label="API Password" name="zkteco_api_password" :error="true" />
                        <x-form.input type="text" label="Auto-generated API Token" name="zkteco_api_token" :error="true" :isRequired="true" />
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="button" wire:click="generateZktecoToken" class="btn bg-info text-white">
                            Generate Token
                        </button>
                        <x-form.button type="submit" text="Save Changes" />
                    </div>
                </form>

                <div class="mt-4 rounded bg-gray-50 p-3 text-sm">
                    <h5 class="font-semibold mb-2">Business Rules</h5>
                    <ul class="list-disc ml-5 space-y-1 text-gray-600">
                        <li>First punch = Clock-In</li>
                        <li>Last punch = Clock-Out</li>
                        <li>Multiple entries per day are auto-processed</li>
                    </ul>
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
