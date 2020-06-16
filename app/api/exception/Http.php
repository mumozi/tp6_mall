<?php
namespace app\api\exception;

use http\Exception;
use think\exception\Handle;
use think\Response;
use Throwable;

Class Http extends Handle {

    public $httpStatus = 500;

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request   $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        //补充异常获取
        if($e instanceof \think\Exception){
            return show($e->getCode(), $e->getMessage());
        }

        //ApiBase抓取异常
        if($e instanceof \think\exception\HttpResponseException){
            return parent::render($request,  $e);
        }
        if(method_exists($e, "getStatusCode")){
            $httpStatus = $e->getStatusCode();
        } else{
            $httpStatus = $this->httpStatus;
        }
        // 添加自定义异常处理机制
        return show(config("status.error"), $e->getMessage(), [], $httpStatus);
    }
}