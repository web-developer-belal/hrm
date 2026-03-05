<?php
namespace App\Livewire\Admin;

use App\Models\AttendanceLog;
use App\Models\Device;
use App\Models\DeviceSyncHistories;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Rats\Zkteco\Lib\ZKTeco;

#[Title('Settings')]
class SettingManagement extends Component
{
    use WithFileUploads;

    public $company_name             = '';
    public $phone_number             = '';
    public $alternative_phone_number = '';
    public $email_address            = '';
    public $company_address          = '';
    public $website_url              = '';
    public $company_logo;
    public $company_logo_path = '';
    public $favicon;
    public $favicon_path = '';

    public $system_language       = 'en';
    public $date_format           = 'Y-m-d';
    public $time_format           = 'H:i';
    public $time_zone             = 'UTC';
    public $enable_ip_restriction = false;

    public $mail_driver     = 'smtp';
    public $smtp_host       = '';
    public $smtp_port       = '';
    public $smtp_username   = '';
    public $smtp_password   = '';
    public $smtp_encryption = 'tls';
    public $smtp_from_email = '';
    public $smtp_from_name  = '';

    public $zkteco_device_url   = '';
    public $zkteco_api_username = '';
    public $zkteco_api_password = '';
    public $zkteco_api_token    = '';

    public $cacheSize = '0 B';

    public $name;
    public $ip_address;
    public $port;
    public $status;
    public $device_id;

    public function mount(): void
    {
        $this->loadSettingsFromDatabase();
        $this->loadEnvSettings();
        $this->cacheSize = $this->getCurrentCacheSize();
    }

    private function loadSettingsFromDatabase(): void
    {
        $settings = Setting::pluck('value', 'key');

        $this->company_name             = $settings->get('company_name', '');
        $this->phone_number             = $settings->get('phone_number', '');
        $this->alternative_phone_number = $settings->get('alternative_phone_number', '');
        $this->email_address            = $settings->get('email_address', '');
        $this->company_address          = $settings->get('company_address', '');
        $this->website_url              = $settings->get('website_url', '');
        $this->company_logo_path        = $settings->get('company_logo_path', '');
        $this->favicon_path             = $settings->get('favicon_path', '');

        $this->system_language       = $settings->get('system_language', 'en');
        $this->date_format           = $settings->get('date_format', 'Y-m-d');
        $this->time_format           = $settings->get('time_format', 'H:i');
        $this->time_zone             = $settings->get('time_zone', 'UTC');
        $this->enable_ip_restriction = (bool) $settings->get('enable_ip_restriction', false);
    }

    private function loadEnvSettings(): void
    {
        $this->mail_driver     = env('MAIL_MAILER', 'smtp');
        $this->smtp_host       = env('MAIL_HOST', '');
        $this->smtp_port       = (string) env('MAIL_PORT', '');
        $this->smtp_username   = env('MAIL_USERNAME', '');
        $this->smtp_password   = env('MAIL_PASSWORD', '');
        $this->smtp_encryption = env('MAIL_ENCRYPTION', 'tls');
        $this->smtp_from_email = env('MAIL_FROM_ADDRESS', '');
        $this->smtp_from_name  = env('MAIL_FROM_NAME', '');

        $this->zkteco_device_url   = env('ZKTECO_DEVICE_URL', '');
        $this->zkteco_api_username = env('ZKTECO_API_USERNAME', '');
        $this->zkteco_api_password = env('ZKTECO_API_PASSWORD', '');
        $this->zkteco_api_token    = env('ZKTECO_API_TOKEN', '');
    }

    private function saveSetting(string $key, $value): void
    {
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public function saveCompanySettings(): void
    {
        $this->validate([
            'company_name'             => ['required', 'string', 'max:255'],
            'phone_number'             => ['nullable', 'string', 'max:50'],
            'alternative_phone_number' => ['nullable', 'string', 'max:50'],
            'email_address'            => ['nullable', 'email', 'max:255'],
            'company_address'          => ['nullable', 'string'],
            'website_url'              => ['nullable', 'url', 'max:255'],
            'company_logo'             => ['nullable', 'image', 'max:2048'],
            'favicon'                  => ['nullable', 'image', 'max:1024'],
        ]);

        if ($this->company_logo) {
            if ($this->company_logo_path) {
                deleteImage($this->company_logo_path);
            }

            $storedLogo              = storeImage($this->company_logo, 'uploads/settings');
            $this->company_logo_path = 'storage/' . $storedLogo;
            $this->company_logo      = null;
        }

        if ($this->favicon) {
            if ($this->favicon_path) {
                deleteImage($this->favicon_path);
            }

            $storedFavicon      = storeImage($this->favicon, 'uploads/settings');
            $this->favicon_path = 'storage/' . $storedFavicon;
            $this->favicon      = null;
        }

        $this->saveSetting('company_name', $this->company_name);
        $this->saveSetting('phone_number', $this->phone_number);
        $this->saveSetting('alternative_phone_number', $this->alternative_phone_number);
        $this->saveSetting('email_address', $this->email_address);
        $this->saveSetting('company_address', $this->company_address);
        $this->saveSetting('website_url', $this->website_url);
        $this->saveSetting('company_logo_path', $this->company_logo_path);
        $this->saveSetting('favicon_path', $this->favicon_path);

        session()->flash('success', 'Company settings saved successfully.');
    }

    public function company_logoRemoveFile($path): void
    {
        if ($this->company_logo_path === $path) {
            deleteImage($path);
            $this->company_logo_path = '';
            $this->saveSetting('company_logo_path', '');
        }
    }

    public function faviconRemoveFile($path): void
    {
        if ($this->favicon_path === $path) {
            deleteImage($path);
            $this->favicon_path = '';
            $this->saveSetting('favicon_path', '');
        }
    }

    public function saveSystemSettings(): void
    {
        $this->validate([
            'system_language'       => ['required', 'string', 'max:20'],
            'date_format'           => ['required', 'string', 'max:30'],
            'time_format'           => ['required', 'string', 'max:30'],
            'time_zone'             => ['required', 'string', 'max:100'],
            'enable_ip_restriction' => ['boolean'],
        ]);

        $this->saveSetting('system_language', $this->system_language);
        $this->saveSetting('date_format', $this->date_format);
        $this->saveSetting('time_format', $this->time_format);
        $this->saveSetting('time_zone', $this->time_zone);
        $this->saveSetting('enable_ip_restriction', (int) $this->enable_ip_restriction);

        session()->flash('success', 'System settings saved successfully.');
    }

    public function saveSmtpSettings(): void
    {
        $this->validate([
            'mail_driver'     => ['required', 'string', 'max:50'],
            'smtp_host'       => ['required', 'string', 'max:255'],
            'smtp_port'       => ['required', 'numeric'],
            'smtp_username'   => ['required', 'string', 'max:255'],
            'smtp_password'   => ['required', 'string', 'max:255'],
            'smtp_encryption' => ['nullable', 'in:tls,ssl'],
            'smtp_from_email' => ['required', 'email', 'max:255'],
            'smtp_from_name'  => ['required', 'string', 'max:255'],
        ]);

        $this->setEnvValues([
            'MAIL_MAILER'       => $this->mail_driver,
            'MAIL_HOST'         => $this->smtp_host,
            'MAIL_PORT'         => $this->smtp_port,
            'MAIL_USERNAME'     => $this->smtp_username,
            'MAIL_PASSWORD'     => $this->smtp_password,
            'MAIL_ENCRYPTION'   => $this->smtp_encryption,
            'MAIL_FROM_ADDRESS' => $this->smtp_from_email,
            'MAIL_FROM_NAME'    => '"' . addslashes($this->smtp_from_name) . '"',
        ]);

        Artisan::call('config:clear');
        session()->flash('success', 'SMTP settings saved to .env successfully.');
    }

    public function saveDeviceIP()
    {
        $validateData = $this->validate([
            'name'       => ['required', 'string', 'max:255'],
            'ip_address' => ['required', 'ip'],
            'port'       => ['nullable', 'numeric'],
            'status'     => ['required', 'in:0,1'],
        ]);

        if ($this->device_id) {
            $device = Device::find($this->device_id);
            $device->update($validateData);
            session()->flash('success', 'Device updated successfully.');
        } else {
            Device::create($validateData);
            session()->flash('success', 'Device created successfully.');
        }

        $this->reset(['name', 'ip_address', 'port', 'status', 'device_id']);
        $this->dispatch('deviceFormClose');
    }

    public function addDevice($deviceId = null)
    {
        if ($deviceId) {
            $device = Device::find($deviceId);
            if ($device) {
                $this->device_id  = $device->id;
                $this->name       = $device->name;
                $this->ip_address = $device->ip_address;
                $this->port       = $device->port;
                $this->status     = $device->status;
            }
        } else {
            $this->reset(['name', 'ip_address', 'port', 'status', 'device_id']);
        }
        $this->dispatch('deviceFormOpen');
    }

    public function resetDeviceForm()
    {
        $this->reset(['name', 'ip_address', 'port', 'status', 'device_id']);
    }

    public function deleteDevice($deviceId)
    {
        $device = Device::find($deviceId);
        if ($device) {
            $device->delete();
            session()->flash('success', 'Device deleted successfully.');
        }
    }

    public function sync($deviceId)
    {
        $device = Device::find($deviceId);

        $history = DeviceSyncHistories::create([
            'device_id'       => $device->id,
            'sync_started_at' => now(),
            'status'          => 'processing',
        ]);

        try {
            $zk = new ZKTeco($device->ip_address, $device->port);
            $zk->connect();
            $logs = $zk->getAttendance();
            $zk->disconnect();

            $count = 0;

            foreach ($logs as $log) {

                $timestamp = Carbon::parse($log['timestamp']);

                $minuteKey = $timestamp->format('Y-m-d H:i');

                AttendanceLog::firstOrCreate(
                    [
                        'employee_id' => $log['id'],
                        // 'attendance_minute' => $minuteKey,
                    ],
                    [
                        'attendance_minute' => $minuteKey,
                        'device_id'         => $device->id,
                        'attendance_date'   => $timestamp->format('Y-m-d'),
                        'attendance_time'   => $timestamp->format('H:i:s'),
                        'device_timestamp'  => $timestamp,
                    ]
                );

                $count++;
            }

            $history->update([
                'total_logs'        => $count,
                'sync_completed_at' => now(),
                'status'            => 'success',
            ]);

        } catch (\Exception $e) {

            $history->update([
                'status'            => 'failed',
                'message'           => $e->getMessage(),
                'sync_completed_at' => now(),
            ]);
        }
    }

    public function clearCache(): void
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');

        $this->cacheSize = $this->getCurrentCacheSize();
        session()->flash('success', 'Application, route, view and config cache cleared successfully.');
    }

    private function setEnvValues(array $values): void
    {
        $envPath = base_path('.env');

        if (! File::exists($envPath)) {
            return;
        }

        $content = File::get($envPath);

        foreach ($values as $key => $value) {
            $formattedValue = (string) $value;
            $formattedValue = preg_replace('/\r?\n/', '', $formattedValue);

            $pattern = "/^{$key}=.*/m";
            $line    = "{$key}={$formattedValue}";

            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, $line, $content);
            } else {
                $content .= PHP_EOL . $line;
            }
        }

        File::put($envPath, $content);
    }

    private function getCurrentCacheSize(): string
    {
        $paths = [
            storage_path('framework/cache'),
            storage_path('framework/views'),
            base_path('bootstrap/cache'),
        ];

        $bytes = 0;
        foreach ($paths as $path) {
            if (! File::exists($path)) {
                continue;
            }

            foreach (File::allFiles($path) as $file) {
                $bytes += $file->getSize();
            }
        }

        if ($bytes < 1024) {
            return $bytes . ' B';
        }

        if ($bytes < 1048576) {
            return round($bytes / 1024, 2) . ' KB';
        }

        if ($bytes < 1073741824) {
            return round($bytes / 1048576, 2) . ' MB';
        }

        return round($bytes / 1073741824, 2) . ' GB';
    }

    public function render()
    {
        $syncHistory = DeviceSyncHistories::with('device')->latest()->paginate(10, ['*'], 'sync_page');
        $devices = Device::latest()->get();
        return view('livewire.admin.setting-management', [
            'syncHistory' => $syncHistory,
            'devices' => $devices,
        ]);
    }
}
