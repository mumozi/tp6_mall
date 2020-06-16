<?php

//严格模式开启
declare(strict_types=1);
namespace app\api\controller;


use app\BaseController;
use think\exception\ValidateException;
use app\common\business\Sms as SmsBus;
class Sms extends BaseController
{
    public function code() :object {

        $phoneNumber = input('param.phone_number','','trim');
        $data = [
            'phone_number' => $phoneNumber,
        ];
        try {
            validate(\app\api\validate\User::class)->scene('send_code')->check($data);
        }catch (ValidateException $e){
            return show(config("status.error"), $e->getError());
        }

        //调用business层数据
        if (SmsBus::sendCode($phoneNumber, 4, "ali")) {
            return show(config("status.success"), "发送验证码成功");
        }
        return show(config("status.error"), "发送验证码失败");
    }
}