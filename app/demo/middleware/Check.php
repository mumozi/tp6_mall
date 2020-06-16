<?php


namespace app\demo\middleware;


class Check
{
    public function handle($request, \Closure $next)
    {
        $request->type ="axc";
        return $next($request);
    }
}