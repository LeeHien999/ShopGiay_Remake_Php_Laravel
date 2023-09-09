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

    public function active($id)
    {
        $check = DanhSachTaiKhoan::where('active_code', $id)->first();
        if($check)
        {
            $check->tinh_trang = 1;     //1 là được kích hoạt, 0 là chưa kích hoạt
            $check->active_code = null;
            $check->save();
            toastr()->success('kích hoạt tài khoản thành công !');
            return redirect('/home/login');
        }
        else
        {
            toastr()->error('Liên kết không tồn tại');
            return redirect('/');

        }
    }

    public function forgotPassword()
    {
        return view('client.pages.reset_password.forgot_password');

    }

    public function resetPassword($id)
    {
        $taikhoan = DanhSachTaiKhoan::where('change_password_code', $id)->first();
        if($taikhoan)
        {
            return view('client.pages.reset_password.change_password', compact('id'));
        }else
        {
            toastr()->error('liên kết không tồn tại !');
            return redirect('/');
        }


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
