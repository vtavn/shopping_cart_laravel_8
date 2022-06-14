<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::insert([
            ['name' => 'admin', 'display_name' => 'Quản trị viên'],
            ['name' => 'guest', 'display_name' => 'Khách hàng'],
            ['name' => 'developer', 'display_name' => 'DEV'],
            ['name' => 'content', 'display_name' => 'Cộng tác viên'],
        ]);
    }
}
