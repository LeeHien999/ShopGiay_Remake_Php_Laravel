<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class APIClientMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //vì cái này là trực tiếp trên trang home không phải là chuyển trang nên trả về json
        $check = Session::get('auth');
        if(!$check)
        {
            return response()->json([
                'status' => 0,
                'message' => 'chức năng này yêu cầu phải đăng nhập !',
            ]);
        }
        return $next($request);
    }
}
