<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class create_RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name'=>'admin','display_name'=>'Quarn trị hệ thống',"status"=>1],
            ['name'=>'guest','display_name'=>'Khách hàng',"status"=>1],
            ['name'=>'developer','display_name'=>'Phát triển hệ thống',"status"=>1],
            ['name'=>'manager','display_name'=>'Quản lý danh mục',"status"=>1],
        ]);
    }
}
