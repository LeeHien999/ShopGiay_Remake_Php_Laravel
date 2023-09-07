<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('admins')->delete();

        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            [
                'username'          =>  'admin',
                'email'             =>  "admin@master.com",
                'password'          =>  bcrypt(123456),
                'ho_va_ten'         =>  "Admin",
                'id_quyen'          =>  1,
                'ngay_sinh'         =>  "2002-10-15",
                'que_quan'          =>  "Đà Nẵng",
                'so_dien_thoai'     =>  "0333314445",
                'gioi_tinh'         =>  random_int(0, 1),
                'cccd'              =>  060701023012,
                'is_block'          =>  random_int(0, 1),
            ],
        ]);
    }
}
