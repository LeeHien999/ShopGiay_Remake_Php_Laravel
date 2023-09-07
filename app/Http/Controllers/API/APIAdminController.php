<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIAdminController extends Controller
{
    //
    public function Adminlogin(Request $request)
    {
        $check  = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if($check == true) {
            return response()->json([
                'status'    => 1,
                'message'   => 'Đã đăng nhập thành công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Tài khoản hoặc mật khẩu không đúng!',
            ]);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data   = $request->all();
            //mã hóa mật khẩu sau đó mới tạo
            $data["password"] = bcrypt($data["password"]);
            Admin::create($data);
            DB::commit();

            return response()->json([
                'status'    => true,
                'message'   => 'Đã thêm mới tài khoản thành công!'
            ]);

        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }

    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $admin   = Admin::find($request->id);
            if($admin) {
                $data   = $request->all();
                $admin->update($data);
                DB::commit();
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa tài khoản thành công!'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'tài khoản không tồn tại!'
                ]);
            }
        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }

    }

    public function data()
    {
        $data   = Admin:: join('quyens', 'admins.id_quyen', 'quyens.id')
                        ->select('admins.*', 'quyens.ten_quyen')
                        ->get();

        return response()->json([
            'data'    => $data,
        ]);
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $admin   = Admin::find($request->id);

            if($admin) {
                $admin->delete();
                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa tài khoản thành công!'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản không tồn tại!'
                ]);
            }

        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }

    }

    public function block(Request $request)
    {
        DB::beginTransaction();
        try {
            $admin   = Admin::find($request->id);
            // dd($admin);
            if($admin) {
                if($admin->is_block == 1) {
                    $admin->is_block = 0;
                } else {
                    $admin->is_block = 1;
                }
                $admin->save();
                DB::commit();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật trạng thái!'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản không tồn tại!'
                ]);
            }

        } catch(Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }
}
