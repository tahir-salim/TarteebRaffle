<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;

class CountryService {
    const COUNTRY_CACHE_KEY = 'countries-cached';

    protected $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function getCachedCountries(){
        return Cache::remember(self::COUNTRY_CACHE_KEY, now()->addDays(7), function(){
            return $this->getCountries();
        });
    }

    public function removeCache(){
        Cache::forget(self::COUNTRY_CACHE_KEY);
    }

    public function getCountries(){
        return $this->country->get();
    }
}
