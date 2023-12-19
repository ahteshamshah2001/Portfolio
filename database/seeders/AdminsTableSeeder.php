<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() == 'local') {
            DB::table('admins')->truncate();
        }

        DB::table('admins')->insert([
            'first_name' => 'Admin',
            'last_name'  => 'Admin',
            'phone'      => '123456789',
            'email'      => 'admin@example.com',
            'password'   => bcrypt('@dmin123'),
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
