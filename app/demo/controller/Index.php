<?php


namespace app\demo\controller;


use app\BaseController;

class index extends BaseController
{
public function hello() {
    return time();
}
}