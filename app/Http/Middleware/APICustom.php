<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
class APICustom
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
        //fixed to bugs
        $start = microtime(true);
        
        if(g('debug')) {
            return $next($request);
        }

        if(!Cache::has('appsLogin'.$request->get('sessionID'))) {
            return response()->json(['api_status'=>0,'api_message'=>'LOGIN_REQUIRED!']);
        }
        
        //Old statement
        //return $next($request);
        
        //fixed to bugs
        $response = $next($request);
        $time_elapsed_secs = microtime(true) - $start;
        \Log::info("API ".$_SERVER['HTTP_USER_AGENT']." : ".$request->fullUrl()." (in ".$time_elapsed_secs."s)");
        return $response;
    }
}
