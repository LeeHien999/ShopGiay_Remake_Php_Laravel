<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariants;
use Illuminate\Http\Request;

class APIProductVariantController extends Controller
{
    //
    public function data(Request $request)
    {

        $data = ProductVariants::where('product_id', $request->id)
                                ->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
