<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = [
            [
                'name' => 'WHITEMOON JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'AL MAHMOOD PEARL JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'AL SARRAJ JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'PRAKASH AMRITLAL JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'MATTAR JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'MUKESH & BROTHERS JEWELLRS',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'SHRINGAR JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'SONA JEWELLERS WLL',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'WESTERN JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'LIBERTY JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'KANSARA JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'RATILAL BHAGWANJI JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'AL YAFIE JEWELLERY CO WLL',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'AL SEEF JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'CHHAGANLAL KHIMJI JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'BANSRI JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'AL HASHIMI PEARLS',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'BHASKAR DEVJI COMPANY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'RAMESH JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'SAMRAT JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'NEW JUMBO JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'CITY JUMBO JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'CITY DILU JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'B KESHAVLAL JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'SHINE JEWELLERY WLL',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'KAPIL JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'DINESH DEVJI JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'CHANDANI JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'APSARA JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'MASOOMA JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'HARSH JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'HAZEEM JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'RAMZANA JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'SIRAJ JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'DANAT AL JASRA/JASRA JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'MUKESH BROTHERS',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'GULF PEARL',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'TARIQ JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'MAJDI JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'BASIM JEWELLERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'SONA JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'RASHA JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'LE-VENCHI',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'PEARL PALACE',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'B. KESHAVLAL',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'SARHAN PEARL',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'DIWAN JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'MANISH JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'JAMEEL JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'SANTRE ANTIQS',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'AL-REFI JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'TABABAT AL BAHRAIN',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'NEW DREAMS WATCHES',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'STAR ELITE JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'SEEMA JEWELERY',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'BIN RAJAB',
                'is_active' => true,
                "created_at" =>  Carbon::now(), # \Datetime()
                "updated_at" => Carbon::now()   # \Datetime()
            ],
        ];
        
        DB::table('shops')->insert($shops);
    }
}
