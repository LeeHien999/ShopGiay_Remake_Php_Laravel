<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use App\Models\GioHang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Foreach_;

class APIDonHangController extends Controller
{
    //
    public function orderComplete(Request $request)
    {
        $data = $request->all();
        $info = $data['info'];
        $products = $data['products'];

        DB::beginTransaction();
        try {
            //tjao đơn hàng
            $donhang = DonHang::create([
                'user_id' => Session::get('auth')->id,
                'tong_tien' => $info['tong_tien'],
                'ten_nguoi_nhan' => $info['ten_nguoi_nhan'],
                'dia_chi'   => $info['dia_chi'],
                'so_dien_thoai' => $info['so_dien_thoai'],
                'hinh_thuc_thanh_toan' => $info['hinh_thuc_thanh_toan'],
                'trang_thai'    => 1,   //1: là đang xử lý
            ]);

            //tạo dữ liệu cho chi tiết đơn hàng
            foreach ($products as $key => $value) {
                ChiTietDonHang::create([
                    'don_hang_id' => $donhang->id,
                    'san_pham_id' => $value['id'],
                    'so_luong'    => $value['so_luong'],
                ]);
            }

            //xóa hết sản phẩm trong giỏ hàng
            $products2 = GioHang::where('user_id', Session::get('auth')->id)
                ->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Đặt hàng thành công !'
            ]);

            DB::commit();
            return response()->json([
                'status' => 1,
                'message' => 'đặt hàng thành công',
            ]);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => 'có lỗi xảy ra,Vui lòng kiểm tra lại !',
            ]);
        }
    }
}
