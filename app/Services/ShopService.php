<?php

namespace App\Services;

use App\Models\Shop;
use Illuminate\Support\Facades\Cache;

class ShopService {
    const SHOP_CACHE_KEY = 'shops-cached';

    protected $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    public function getCachedShops(){
        $this->removeCache();
        return Cache::remember(self::SHOP_CACHE_KEY, now()->addDays(7), function(){
            return $this->getShops();
        });
    }

    public function removeCache(){
        Cache::forget(self::SHOP_CACHE_KEY);
    }

    public function getShops(){
        return $this->shop->active()->orderBy('name')->get();

    }
}
