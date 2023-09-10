<?php

namespace App\Http\Controllers;

use App\Models\DanhSachTaiKhoan;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $check = DanhSachTaiKhoan::where('checkout_code', $id)->first();
        if($check)
        {
            $check->checkout_code = null;
            $check->save();
            return view('client.pages.cart.checkout');
        }
        else
        {
            toastr()->error('Liên kết không tồn tại !');
            return redirect('/');
        }
    }

    public function orderComplete()
    {
        return view('client.pages.cart.OrderComplete');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DonHang $donHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonHang $donHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonHang $donHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonHang $donHang)
    {
        //
    }
}
