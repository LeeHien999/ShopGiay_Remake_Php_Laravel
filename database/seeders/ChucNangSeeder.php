<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucNangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chuc_nangs')->delete();

        DB::table('chuc_nangs')->truncate();

        DB::table('chuc_nangs')->insert([
            [
                'id'                =>  100,
                'ten_chuc_nang'     =>  'Tạo Mới product',
                'ten_group'         =>  'Product',
            ],
            [
                'id'                =>  101,
                'ten_chuc_nang'     =>  'Xem Thông Tin sản phẩm',
                'ten_group'         =>  'Product',
            ],
            [
                'id'                =>  102,
                'ten_chuc_nang'     =>  'Đổi Trạng Thái Product',
                'ten_group'         =>  'Product',
            ],
            [
                'id'                =>  103,
                'ten_chuc_nang'     =>  'Xem Chi Tiết Product',
                'ten_group'         =>  'Product',
            ],
            [
                'id'                =>  104,
                'ten_chuc_nang'     =>  'Xóa Product',
                'ten_group'         =>  'Product',
            ],
            [
                'id'                =>  105,
                'ten_chuc_nang'     =>  'Cập Nhật Product',
                'ten_group'         =>  'Product',
            ],
            [
                'id'                =>  106,
                'ten_chuc_nang'     =>  'Tạo Mới Tài Khoản Khách Hàng',
                'ten_group'         =>  'Tài Khoản Khách',
            ],
            [
                'id'                =>  107,
                'ten_chuc_nang'     =>  'Lấy Thông Tin Khách Hàng',
                'ten_group'         =>  'Tài Khoản Khách',
            ],
        ]);
    }
}
