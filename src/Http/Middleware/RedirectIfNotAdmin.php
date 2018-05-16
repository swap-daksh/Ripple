<?php

namespace YPC\Ripple\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
class RedirectIfNotAdmin{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function handle($request, Closure $next){
         if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return $next($request);
            } elseif(Auth::user()->role == 'dealer') {
                return redirect('dashboard');
            }
            
            else{
                return redirect()->route('home');
            }
         }
         return redirect()->route('Ripple::adminLoginForm');
     }
}