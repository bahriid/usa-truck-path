<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeoIPService
{
    /**
     * Get the country code for an IP address
     *
     * @param string|null $ip The IP address to look up (defaults to request IP)
     * @return string|null ISO 3166-1 alpha-2 country code or null if detection fails
     */
    public function getCountryCode(?string $ip = null): ?string
    {
        $ip = $ip ?? request()->ip();

        // Skip for local/private IPs - return null to show all courses
        if ($this->isPrivateIP($ip)) {
            return null;
        }

        $cacheKey = "geoip:{$ip}";

        return Cache::remember($cacheKey, 86400, function () use ($ip) {
            return $this->fetchCountryCode($ip);
        });
    }

    /**
     * Fetch country code from ip-api.com
     *
     * @param string $ip
     * @return string|null
     */
    protected function fetchCountryCode(string $ip): ?string
    {
        try {
            $response = Http::timeout(3)->get("http://ip-api.com/json/{$ip}", [
                'fields' => 'status,countryCode',
            ]);

            if ($response->successful() && $response->json('status') === 'success') {
                return $response->json('countryCode');
            }

            Log::warning("GeoIP lookup failed for IP: {$ip}", [
                'response' => $response->json(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error("GeoIP service error: {$e->getMessage()}");

            return null;
        }
    }

    /**
     * Check if an IP address is private/local
     *
     * @param string $ip
     * @return bool
     */
    protected function isPrivateIP(string $ip): bool
    {
        // Check for localhost
        if ($ip === '127.0.0.1' || $ip === '::1' || $ip === 'localhost') {
            return true;
        }

        // Check for private IP ranges
        return filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        ) === false;
    }

    /**
     * Clear cached country code for an IP
     *
     * @param string $ip
     * @return void
     */
    public function clearCache(string $ip): void
    {
        Cache::forget("geoip:{$ip}");
    }
}
