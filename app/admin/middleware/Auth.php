<?php


namespace app\admin\middleware;


class Auth
{
    public function handle($request, \Closure $next)
    {
        if (empty(session(config("admin.session_admin"))) && !preg_match("/login/", $request->pathinfo())) {
            return redirect(url("login/index"));
        }
        //前置处理
        $response = $next($request);

        return $response;
    }

    public function end(){

    }
}