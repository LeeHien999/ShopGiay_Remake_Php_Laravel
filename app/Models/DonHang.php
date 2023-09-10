<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = 'don_hangs';
    protected $fillable = [
        'user_id',
        'tong_tien',
        'ten_nguoi_nhan',
        'dia_chi',
        'so_dien_thoai',
        'hinh_thuc_thanh_toan',
        'trang_thai',
    ];

}
