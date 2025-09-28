<?php

use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

/**
 * Get single setting value with cache (1 hour).
 */
if (!function_exists('gs')) {
    function gs(string $key, $default = null) {
        return Cache::remember("setting:{$key}", 3600, function () use ($key, $default) {
            return Setting::where('key', $key)->value('value') ?? $default;
        });
    }
}

/**
 * Decode buttons_config JSON (built full config), return as array.
 * Structure: [ 'home' => [ {...},{...} ], 'member' => [ ... ], ... ]
 */
if (!function_exists('buttons_config')) {
    function buttons_config(): array {
        $json = gs('buttons_config', '');
        if (!$json) return [];

        try {
            $arr = json_decode($json, true, flags: JSON_THROW_ON_ERROR);
            return is_array($arr) ? $arr : [];
        } catch (\Throwable $e) {
            // corrupted JSON -> ignore and return empty
            return [];
        }
    }
}

/**
 * Fetch a single button config by page + key.
 * Example: button_cfg('home', 'join_us')
 * Returns the button array or null.
 */
if (!function_exists('button_cfg')) {
    function button_cfg(string $page, string $btnKey): ?array {
        $cfg = buttons_config();
        if (!isset($cfg[$page]) || !is_array($cfg[$page])) {
            return null;
        }

        foreach ($cfg[$page] as $btn) {
            if (($btn['key'] ?? null) === $btnKey) {
                return $btn;
            }
        }

        return null;
    }
}

/**
 * Convenience: check if a button is enabled.
 */
if (!function_exists('button_enabled')) {
    function button_enabled(string $page, string $btnKey): bool {
        $btn = button_cfg($page, $btnKey);
        return $btn && ($btn['enabled'] ?? false);
    }
}
