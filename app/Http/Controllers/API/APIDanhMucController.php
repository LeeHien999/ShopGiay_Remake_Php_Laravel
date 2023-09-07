<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\Giay;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIDanhMucController extends Controller
{
    //
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $check = DanhMuc::where('ten_danh_muc', $request->ten_danh_muc)->first();
            if($check)
            {
                return response()->json([
                    'status' => 0,
                    'message' => 'Danh mục đã tồn tại !!',
                ]);
            }
            $data = $request->all();
            DanhMuc::create($data);
            DB::commit();

            return response()->json([
                'status' => 1,
                'message' => 'Thêm mới thành công',
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

    public function status(Request $request)
    {

        DB::beginTransaction();
        try {
            $DanhMuc = DanhMuc::find($request->id);
            if ($DanhMuc) {
                $DanhMuc->trang_thai = !$DanhMuc->trang_thai;
                $DanhMuc->save();
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
            $DanhMuc = DanhMuc::find($request->id);
            $check = DanhMuc::where('ten_danh_muc', $request->ten_danh_muc)
                                ->where('id', '!=', $request->id)->first();
            if ($DanhMuc && !$check) {
                $DanhMuc->update($data);
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Cập nhật thành công',
                ]);
            } else
                return response()->json([
                    'status' => 0,
                    'message' => 'trùng Danh mục, hoặc sai id vui lòng nhập lại!!',
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
            $giays = Giay::where('Danh_Muc_Id', $request->id)->first();
            $DanhMuc = DanhMuc::find($request->id);
            if ($DanhMuc && !$giays) {
                $DanhMuc->delete();
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Xóa thành công',
                ]);
            } else
                return response()->json([
                    'status' => 0,
                    'message' => 'Có giày sử dụng Danh mục này, xóa thất bại !!',
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
        $data = DanhMuc::all();
        return response()->json([
            'data' => $data
        ]);
    }
}
