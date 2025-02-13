<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'name' => 'MIN_RECEIPT_AMOUNT',
                'value' => 30,
                "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                "updated_at" => \Carbon\Carbon::now()   # \Datetime()
            ],
            [
                'name' => 'MIN_ENTRY_AMOUNT',
                'value' => 100,
                "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                "updated_at" => \Carbon\Carbon::now()   # \Datetime()
            ]
        ];

        DB::table('settings')->insert($settings);
    }
}
