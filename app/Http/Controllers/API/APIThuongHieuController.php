<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Giay;
use App\Models\ThuongHieu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIThuongHieuController extends Controller
{
    //
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $check = ThuongHieu::where('ten_thuong_hieu', $request->ten_thuong_hieu)->first();
            if (!$check) {
                $data = $request->all();
                ThuongHieu::create($data);
                DB::commit();

                return response()->json([
                    'status' => 1,
                    'message' => 'Thêm mới thành công',
                ]);
            } else
            {
                return response()->json([
                    'status' => 0,
                    'message' => 'trùng thương hiệu, thêm thất bại !!',
                ]);
            }

        } catch (Exception $E) {
            Log::error($E);
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => 'Có lỗi xảy ra: ' . $E->getMessage(),
            ]);
        }
    }

    public function status(Request $request)
    {

        DB::beginTransaction();
        try {
            $thuonghieu = ThuongHieu::find($request->id);
            if ($thuonghieu) {
                $thuonghieu->Tinh_Trang = !$thuonghieu->Tinh_Trang;
                $thuonghieu->save();
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Cập nhật trạng thái thành công',
                ]);
            } else
                return response()->json([
                    'status' => 0,
                    'message' => 'Cập nhật trạng thái thất bại!!',
                ]);
        } catch (Exception $E) {
            Log::error($E);
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => 'Có lỗi xảy ra: ' . $E->getMessage(),
            ]);
        }
    }

    public function update(Request $request)
    {

        DB::beginTransaction();
        try {
            $data = $request->all();
            $thuonghieu = ThuongHieu::find($request->id);
            if ($thuonghieu) {
                $thuonghieu->update($data);
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Cập nhật thành công',
                ]);
            } else
                return response()->json([
                    'status' => 0,
                    'message' => 'Cập nhật thất bại!!',
                ]);
        } catch (Exception $E) {
            Log::error($E);
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => 'Có lỗi xảy ra: ' . $E->getMessage(),
            ]);
        }
    }

    public function destroy(Request $request)
    {

        DB::beginTransaction();
        try {
            $giays = Giay::where('Thuong_Hieu_Id', $request->id)->first();
            $thuonghieu = ThuongHieu::find($request->id);
            if ($thuonghieu && !$giays) {
                $thuonghieu->delete();
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Xóa thành công',
                ]);
            } else
                return response()->json([
                    'status' => 0,
                    'message' => 'Có giày đang sử dụng thương hiệu này, Xóa thất bại!!',
                ]);
        } catch (Exception $E) {
            Log::error($E);
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => 'Có lỗi xảy ra: ' . $E->getMessage(),
            ]);
        }
    }


    public function data(Request $request)
    {
        $data = ThuongHieu::all();
        return response()->json([
            'data' => $data
        ]);
    }
}
