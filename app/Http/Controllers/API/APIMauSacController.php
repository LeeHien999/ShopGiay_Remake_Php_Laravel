<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Giay;
use App\Models\MauSac;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIMauSacController extends Controller
{
    //
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $data = $request->all();
            MauSac::create($data);
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
            $mausac = MauSac::find($request->id);
            if ($mausac) {
                $mausac->trang_thai = !$mausac->trang_thai;
                $mausac->save();
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
            $mausac = MauSac::find($request->id);
            if ($mausac) {
                $mausac->update($data);
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
            $giays = Giay::where('Mau_Sac_Id', $request->id)->first();
            $mausac = MauSac::find($request->id);
            if ($mausac && !$giays) {
                $mausac->delete();
                DB::commit();
                return response()->json([
                    'status' => 1,
                    'message' => 'Xóa thành công',
                ]);
            } else
                return response()->json([
                    'status' => 0,
                    'message' => 'Có giày sử dụng màu này, xóa thất bại !!',
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
        $data = MauSac::all();
        return response()->json([
            'data' => $data
        ]);
    }
}
