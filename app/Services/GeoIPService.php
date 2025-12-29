<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeoIPService
{
    /**
     * European country codes (ISO 3166-1 alpha-2)
     */
    protected array $europeanCountries = [
        'AL', 'AD', 'AT', 'BY', 'BE', 'BA', 'BG', 'HR', 'CY', 'CZ',
        'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IS', 'IE', 'IT',
        'XK', 'LV', 'LI', 'LT', 'LU', 'MT', 'MD', 'MC', 'ME', 'NL',
        'MK', 'NO', 'PL', 'PT', 'RO', 'RU', 'SM', 'RS', 'SK', 'SI',
        'ES', 'SE', 'CH', 'UA', 'GB', 'VA',
    ];

    /**
     * Get the region code for an IP address
     * Returns: CA (Canada), US (United States), EU (Europe), GLOBAL (everywhere else)
     *
     * @param string|null $ip The IP address to look up (defaults to request IP)
     * @return string|null Region code or null if detection fails
     */
    public function getRegionCode(?string $ip = null): ?string
    {
        $countryCode = $this->getCountryCode($ip);

        if ($countryCode === null) {
            return null;
        }

        return $this->mapCountryToRegion($countryCode);
    }

    /**
     * Map a country code to a region
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code
     * @return string Region code: CA, US, EU, or GLOBAL
     */
    public function mapCountryToRegion(string $countryCode): string
    {
        // Canada
        if ($countryCode === 'CA') {
            return 'CA';
        }

        // United States
        if ($countryCode === 'US') {
            return 'US';
        }

        // Europe
        if (in_array($countryCode, $this->europeanCountries)) {
            return 'EU';
        }

        // All other regions (Africa, Asia, South America, etc.)
        return 'GLOBAL';
    }

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
