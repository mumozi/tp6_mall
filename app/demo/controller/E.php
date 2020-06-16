<?php


namespace app\demo\controller;


use app\BaseController;
use think\exception\HttpException;

class E extends BaseController
{
    public function index()
    {
        throw new HttpException(404, "找不到相应数据");
    }
}