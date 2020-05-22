<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }


    /**
     * Handle an completion of request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function terminate($request, $response)
    {
      $url=$request->fullUrl();
      $ip=$request->ip();
      $r=new \App\LogRequest();
      $r->ip=$ip;
      $r->url=$url;
      $r->request=json_encode($request->all());
      $r->response=$response;
      $r->save();
    }
}