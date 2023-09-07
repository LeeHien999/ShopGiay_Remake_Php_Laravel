<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class APIAdminMiddel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check  =  Auth::guard('admin')->check();
        if(!$check) {
            toastr()->error("Chức năng yêu cầu phải đăng nhập!");
            return redirect('/admin/login');
        }
        return $next($request);

    }
}
