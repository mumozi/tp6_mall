<?php


namespace app\demo\controller;


use app\BaseController;
use app\common\model\mysql\AdminUser;
use think\facade\Request;

class index extends BaseController
{
    public function hello(AdminUser $adminUser)
    {
        halt($adminUser);
    }
}
