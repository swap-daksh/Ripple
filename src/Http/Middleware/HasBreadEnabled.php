<?php

namespace YPC\Ripple\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Closure;

class HasBreadEnabled
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (DB::table('rpl_breads_meta')->where('table', $request->table)->where('key', 'status')->where('value', '1')->exists()) {
            return $next($request);
        } else {
            abort(404);
        }
    }

}
