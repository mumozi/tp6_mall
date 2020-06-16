<?php
//严格模式开启
declare(strict_types=1);
namespace app\common\lib\sms;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use think\facade\Log;

class BaiduSms
{
    public static function sendCode(string $phone, int $code):bool {

        return true;
    }
}