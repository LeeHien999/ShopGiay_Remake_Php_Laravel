<?php

namespace App\Http\Controllers;

use App\Models\Giay;
use App\Models\MauSac;
use App\Models\Product;
use App\Models\ProductVariants;
use Illuminate\Http\Request;

class TrangChuController extends Controller
{
    //
    public function index()
    {
        $bestSales = Product::orderBy('luot_xem', 'DESC')
            ->where('tinh_trang', 1)
            ->limit(8)
            ->get();

        $manShoes = Product::orderBy('luot_xem', 'asc')
            ->where('gioi_tinh_id', 0)
            ->where('tinh_trang', 1)
            ->limit(4)
            ->get();
        $womanShoes = Product::orderBy('luot_xem', 'asc')
            ->where('gioi_tinh_id', 1)
            ->where('tinh_trang', 1)
            ->limit(4)
            ->get();

        return view('client.pages.home', compact('bestSales', 'manShoes', 'womanShoes'));
    }

    public function menProducts()
    {
        return view('client.pages.men.index');
    }

    public function womenProducts()
    {
        return view('client.pages.women.index');
    }

    public function login()
    {
        return view('client.pages.login.index');
    }

    public function register()
    {
        return view('client.pages.register.index');
    }

    public function detailGiay($id)
    {
        $prod = Product::find($id);
        if ($prod) {
            $options = ProductVariants::join('kich_thuocs', 'product_variants.kich_thuoc_id', 'kich_thuocs.id')
                ->join('mau_sacs', 'product_variants.mau_sac_id', 'mau_sacs.id')
                ->where('product_variants.product_id', $prod->id)
                ->select('product_variants.*', 'kich_thuocs.ten_kich_thuoc', 'mau_sacs.ten_mau_sac')
                ->get();
            $colors = ProductVariants::where('product_id', $prod->id)
                ->join('mau_sacs', 'product_variants.mau_sac_id', '=', 'mau_sacs.id')
                ->select('mau_sacs.id', 'mau_sacs.ten_mau_sac', 'product_variants.hinh_anh')
                ->distinct()
                ->get();

            return view('client.pages.product_detail', compact('prod', 'options', 'colors'));
        } else
            return redirect('/');
    }
}
