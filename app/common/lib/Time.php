<?php


namespace app\common\lib;


class Time
{
    /**用户登陆到期时间
     * @param $type 1=>7天，2=>30天，默认2
     * @return float|int
     */
    public static function userLoginExpiresTime($type = 2){
        $type = !in_array($type, [1,2]) ? 2 : $type;
        if ($type == 1){
            $day = $type * 7;
        }elseif ($type == 2) {
            $day = $type * 30;
        }
        return $day * 24 * 3600;
    }
}