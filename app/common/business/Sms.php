<?php

//严格模式开启
declare(strict_types=1);
namespace app\common\business;


use app\common\lib\ClassArr;
use app\common\lib\Num;
use app\common\lib\sms\AliSms;

class Sms
{
    public static function sendCode(string $phoneNumber, int $len, string $type = 'ali') :bool {

        //生成随机的4位或者6位验证码
        $code = Num::getCode($len);

        //$sms = AliSms::sendCode($phoneNumber, $code);
        //工厂模式调用反射
        $classStats = ClassArr::smsClassStat();
        $classObj = ClassArr::initClass($type, $classStats);
        $sms = $classObj::sendCode($phoneNumber, $code);
        //假设发送成功
        cache(config("redis.code_pre").$phoneNumber, $code, config("redis.code_expire"));

        return true;
        if ($sms) {

            //验证码存放redis。并且给出一个失效时间 1分钟
            //1.php是否又redis扩展
            //2.开启服务
            cache(config("redis.code_pre").$phoneNumber, $code, config("redis.code_expire"));
        }
        return $sms;
    }
}