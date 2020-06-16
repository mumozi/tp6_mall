<?php


namespace app\common\lib;


class Str
{
    /**生成所需的token
     * @param $string
     * @return string
     */
    public static function getLoginToken($string) {
        //生成token
        //生成一个不会重复的字符串
        $str = md5(uniqid(md5(microtime(true)),true));
        return sha1($str.$string);
    }
}