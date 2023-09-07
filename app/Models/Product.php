<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'ten_san_pham',
        'gioi_tinh_id',
        'gia',
        'hinh_anh',
        'mo_ta',
        'danh_muc_id',
        'thuong_hieu_id',
        'luot_xem',
        'tinh_trang'
    ];
}
