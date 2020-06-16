<?php


namespace app\admin\business;
use app\common\model\mysql\AdminUser as AdminUserModel;
use think\Exception;

class AdminUser
{
    public static function login($data) {
        try {
            $adminUser = getAdminUserByUsername($data['username']);
            if(empty($adminUser)){
                throw new Exception("不存在该用户");
            }
            //判断密码是否正确
            if ($adminUser['password'] !=md5($data['password'])) {
                throw new Exception("密码错误");
                //return show(config("status.error"),"密码错误");
            }

            //需要记录信息到mysql表里
            $updateData = [
                'last_login_time' => time(),
                'last_login_ip' => request()->ip(),
                'update_time' =>time(),
            ];
            $res = $adminUserObj->updateById($adminUser['id'], $updateData);

            if (empty($res)) {
                throw new Exception("登陆失败");
                //return show(config("status.error"),"登陆失败");
            }

        }catch (\Exception $e){
            //todo 记录日志$e->getMessage();
            throw new Exception("内部异常，登陆失败");
            //return show(config("status.error"),"内部异常，登陆失败");
        }

//记录session
        session(config("admin.session_admin"), $adminUser);
        return true;
        //return show(config("status.success"),"登陆成功");
    }

    /**通过用户名获取用户信息
     * @param $username
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getAdminUserByUsername($username){
        $adminUserObj  = new AdminUserModel();
        $adminUser =  $adminUserObj->getAdminUserByUsername($username);
        if (empty($adminUser) || $adminUser->status != config("status.mysql.table_normal")) {
            return false;
            //throw new Exception("不存在该用户");
            //return show(config("status.error"),"不存在该用户");
        }
        $adminUser = $adminUser->toArray();
        return $adminUser;
    }
}