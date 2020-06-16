<?php


namespace app\controller;


use app\BaseController;
use app\mode\User;
use think\facade\Db;

class Data extends BaseController
{
    public function index()
    {
        //通过门获取
        $user = Db::table("user")->where("id",1)->find();
        //通过容器获取
        //$user = app("db")->table("user")->where("id",1)->find();
        echo Db::getLastSql();die;
        dump($user);
    }

    public function demo() {
//        $data = [
//            "name" => "liu",
//            "desc" => "mingxi"
//        ];
//        $result = Db::table("user")->insert($data);
//        echo Db::getLastSql();
//        dump($result);

        $user = User::find(1);
        dump($user->toArray());
    }

}