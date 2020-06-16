<?php


namespace app\admin\controller;



use app\admin\business\AdminUser;
use think\Exception;
use think\facade\View;

class Login extends AdminBase
{
    public function initialize()
    {
        if ($this->isLogin()) {
            return $this->redirect(url("index/index"));
        }
    }

    public function index()
    {
        return View::fetch();
    }

    public function check() {
        if (!$this->request->isPost()) {
            return show(config("status.error"),"请求方式错误");
        }

        //参数校验 1.原生方式 2.TP6方式
        $username = $this->request->param("username","","trim");
        $password = $this->request->param("password","","trim");
        $captcha = $this->request->param("captcha","","trim");

        $data = [
            'username' => $username,
            'password' => $password,
            'captcha' => $captcha,
        ];
        //验证规则TP6处理
        $validate = new \app\admin\validate\AdminUser();
        if (!$validate->check($data)) {
            return show(config("status.error"),$validate->getError());
        }

       /* if (empty($username)||empty($password)||empty($captcha)){
            return show(config("status.error"),"参数不允许为空");
        }
        //需要验证验证码
        if (!captcha_check($captcha)) {
            return show(config("status.error"),"验证码不正确");
        }*/
        try {
            $result = AdminUser::login($data);
        }catch (Exception $e){
            return show(config("status.error"),$e->getMessage());
        }

        if ($result) {
            return show(config("status.success"),"登陆成功");
        }else{
            return show(config("status.error"),"登陆失败");
        }

    }
}