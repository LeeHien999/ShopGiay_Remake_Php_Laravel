<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    use HasFactory;
    protected $table = 'thuong_hieus';
    protected $fillable = [
        'ten_thuong_hieu',
        'mo_ta',
        'hinh_anh',
        'trang_thai'
    ];
}
