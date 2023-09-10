<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\GioHang;
use App\Models\KichThuoc;
use App\Models\MauSac;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    //
    public function index()
    {
        $products2 = GioHang::where('user_id', Session::get('auth')->id)
        ->delete();
        foreach ($products2 as $key => $value) {
            $value->delete();
        }
        dd($products2->toArray());
    }
}
