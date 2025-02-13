<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\UserRole;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@klabs.co',
                'password' => bcrypt('admin@tarteeb'),
                'email_verified_at' => \Carbon\Carbon::now(),
                'role' => UserRole::ADMIN,
                "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                "updated_at" => \Carbon\Carbon::now()   # \Datetime()
            ],
        ];
        
        DB::table('users')->insert($user);
    }
}
