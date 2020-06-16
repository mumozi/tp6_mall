<?php


namespace app\common\lib;


class ClassArr
{
    public static function smsClassStat() {
        return [
            'ali' => 'app\common\lib\sms\AliSms',
            'baidu' => 'app\common\lib\sms\BaiduSms',

        ];
    }

    public static function uploadClassStat() {
        return [
          'text' =>  'xxx',
          'image' => 'xxx',
        ];
    }

    public static function initClass($type, $classs, $params = [], $needInstance = false) {
        //如果工厂模式调用的方法是静态的，这里返回类库AliSms
        //非静态则返回对象
        if (!array_key_exists($type, $classs)) {
            return false;
        }
        $className = $classs[$type];
        //new ReflectionClass('A’） => 建立A反射类
        //->newInstanceArgs($args) => 相当于实例化对象
        return $needInstance = true ?(new \ReflectionClass($className))->newInstanceArgs($params) : $className;

    }

}