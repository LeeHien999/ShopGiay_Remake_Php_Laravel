<?php

namespace App\Http\Controllers;

use App\Models\GioHang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class APIGioHangController extends Controller
{
    //
    public function data(Request $request)
    {
        $data = GioHang::join('product_variants', 'gio_hangs.product_id', 'product_variants.id')
            ->join('products', 'product_variants.product_id', 'products.id')
            ->join('kich_thuocs', 'product_variants.kich_thuoc_id', 'kich_thuocs.id')
            ->join('mau_sacs', 'product_variants.mau_sac_id', 'mau_sacs.id')
            ->where('gio_hangs.user_id', Session::get('auth')->id)
            ->select('gio_hangs.*', 'products.ten_san_pham', 'product_variants.hinh_anh','mau_sacs.ten_mau_sac', 'kich_thuocs.ten_kich_thuoc', 'products.gia')
            ->get();
        return response()->json([
            'status' => 1,
            'data' => $data,
        ]);
    }

    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            //kiểm tra sản phẩm đã tồn tại chưa nếu chưa thì tạo mới còn không thì cộng dồn số lượng vào
            $check = GioHang::where('user_id', Session::get('auth')->id)
                ->where('product_id', $request->id)
                ->first();

            if ($check) {
                $check->so_luong += $request->so_luong;
                $check->save();
            } else {
                $giohang = GioHang::create([
                    'user_id'   => Session::get('auth')->id,
                    'product_id' => $request->id,
                    'so_luong'  => $request->so_luong,
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => 1,
                'message' => 'Đã thêm vào giỏ hàng !'
            ]);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 0,
                'message' => 'Thêm thất bại !'
            ]);
            DB::rollBack();
        }
    }

    public function count(Request $request)
    {
        $count = GioHang::where('user_id', Session::get('auth')->id)
            ->sum('so_luong');

        return response()->json([
            'status' => 1,
            'data' => $count,
        ]);
    }
}
