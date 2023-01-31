<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('web')->check()){
            return redirect()->route('login')->with('yes','Vui lòng đăng nhập');
        }elseif(Auth::guard('web')->user()->status == 0){
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('no','Tài khoản của bạn chưa được kích hoạt');
        }
        return $next($request);
    }
}
