<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Giay;
use App\Models\KichThuoc;
use App\Models\Product;
use App\Models\ProductVariants;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIKichThuocController extends Controller
{
    //
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $check = KichThuoc::where('ten_kich_thuoc', $request->ten_kich_thuoc)->first();
            if($check)
            {
                return response()->json([
                    'status' => 0,
                    'message' => 'Kích thước đã tồn tại !!',
                ]);
            }
            $data = $request->all();
            KichThuoc::create($data);
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
            $KichThuoc = KichThuoc::find($request->id);
            if ($KichThuoc) {
                $KichThuoc->trang_thai = !$KichThuoc->trang_thai;
                $KichThuoc->save();
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
            $KichThuoc = KichThuoc::find($request->id);
            $check = KichThuoc::where('ten_kich_thuoc', $request->ten_kich_thuoc)
                                ->where('id', '!=', $request->id)->first();
            if ($KichThuoc && !$check) {
                $KichThuoc->update($data);
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Cập nhật thành công',
                ]);
            } else
                return response()->json([
                    'status' => 0,
                    'message' => 'trùng kích thước, hoặc sai id vui lòng nhập lại!!',
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
            $giays = ProductVariants::where('kich_thuoc_id', $request->id)->first();
            $KichThuoc = KichThuoc::find($request->id);
            if ($KichThuoc && !$giays) {
                $KichThuoc->delete();
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Xóa thành công',
                ]);
            } else
                return response()->json([
                    'status' => 0,
                    'message' => 'Có giày sử dụng kích thước này, xóa thất bại !!',
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
        $data = KichThuoc::orderBy('ten_kich_thuoc', 'asc')->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
