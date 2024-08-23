<?php
namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomAuth
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard)
    {
        // التحقق من أن المستخدم مسجل دخول باستخدام الحارس 'student'
        if (!Auth::guard($guard)->check()) {
            // إذا لم يكن مسجلاً للدخول، إعادة التوجيه إلى صفحة تسجيل الدخول
            return redirect()->route('home');
        }

        // السماح للطلب بالمرور إذا كان المستخدم مسجل دخول
        return $next($request);
    }

}//end CustomAuth
