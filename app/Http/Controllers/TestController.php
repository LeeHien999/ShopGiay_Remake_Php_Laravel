<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\KichThuoc;
use App\Models\MauSac;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function addProduct()
    {
        $kichthuocs = KichThuoc::all();
        $mausacs = MauSac::all();
        $danhmucs = DanhMuc::all();
        $thuonghieus = ThuongHieu::all();
        return view('admin.page.giay.test', compact('kichthuocs', 'mausacs', 'danhmucs', 'thuonghieus'));
    }
}
