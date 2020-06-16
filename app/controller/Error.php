<?php


namespace app\controller;


class Error
{
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return show(config("status.controller_not_found"), "找不到该控制器", null, 400);
    }

}