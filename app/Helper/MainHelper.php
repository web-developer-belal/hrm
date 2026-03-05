<?php

use App\Models\Setting;

if (! function_exists('settingData')) {
    function settingData($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
    
}