<?php


namespace app\api\controller;
use app\common\business\User as UserBis;
use app\api\validate\User as UserVal;
class User extends AuthBase
{
    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index(){
        $user = (new UserBis())->getNormalUserById($this->userId);

        //预处理防止暴露其他信息
        $result = [
            "id" => $this->userId,
            "username" => $user["username"],
            "sex" => $user["sex"],
        ];
        return show(config("status.success"), "ok", $result);
    }

    /**PUT
     * @return \think\response\Json
     */
    public function update(){
        $username = input("param.username", "", "trim");
        $sex = input("param.sex", "", "intval");

        $data = [
            'username' => $username,
            'sex' => $sex,
        ];

        $validate = (new UserVal())->scene("update_user");
        if(!$validate->check($data)) {
            return show(config("status.error"), $validate->getError());
        }
        $userBisObj = new UserBis();
        $user = $userBisObj->update($this->userId, $data);
        if (!$user) {
            return show(config("status.error"), "更新失败");
        }
        //todo 用户名被修改，redis数据同步更改
        return show(config("status.success"), "ok");
    }
}