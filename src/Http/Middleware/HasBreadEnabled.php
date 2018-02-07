<?php

namespace YPC\Ripple\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        if(Schema::hasTable(prefix('breads'))){
            if (DB::table(prefix('breads'))->where('slug', $request->slug)->where('status', '1')->exists()) {
                return $next($request);
            } else {
                abort(404);
            }
        }
    }

}
