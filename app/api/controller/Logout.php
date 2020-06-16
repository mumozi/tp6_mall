<?php


namespace app\api\controller;


class Logout extends AuthBase
{
    public function index() {
        //删除redis token缓存
        $res = cache(config("redis.token_pre").$this->accessToken, NULL);
        if($res){
            return show(config("status.success"), "退出登陆成功");
        }
        return show(config("status.error"), "退出登陆失败");
    }
}