<?php

namespace app\controller;


use think\Request;
class Demo
{
    public function index(Request $request)
    {
        dump($request->param("abc"));
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return show(config("status.action_not_found"), "找不到该{$name}方法" ,null, 404);
    }


}