<?php

namespace App\Http\Controllers;

use App\Models\DanhSachTaiKhoan;
use Illuminate\Http\Request;

class DanhSachTaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.page.danh_sach_tai_khoan.index');
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
    public function show(DanhSachTaiKhoan $danhSachTaiKhoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DanhSachTaiKhoan $danhSachTaiKhoan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DanhSachTaiKhoan $danhSachTaiKhoan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhSachTaiKhoan $danhSachTaiKhoan)
    {
        //
    }
}
