<?php


namespace app\admin\controller;
use app\common\business\Category as CategoryBus;

use app\common\lib\Status;
use think\facade\View;

class Category extends AdminBase
{
    public function index() {
        $pid = input("param.pid", "", "intval");
        $data = [
            "pid" => $pid,
        ];
        $category = new CategoryBus();
        try {
            $categorys = $category->getLists($data, 5);
        }catch (\Exception $e){
            $categorys = [];
        }
        return View::fetch("",[
            "categorys" => $categorys,
        ]);
    }

    public function add() {
        $category = new CategoryBus();
        $categorys = $category->getNormalCategorys();
        return View::fetch("",[
            "categorys" => json_encode($categorys),
        ]);
    }

    public function save() {
        $pid = input("param.pid", 0 ,"intval");
        $name = input("param.name", "", "trim");

        //参数校验
        $data = [
            'pid' => $pid,
            'name' => $name,
        ];

        $validate = new \app\admin\validate\Category();
        if (!$validate->check($data)) {
            return show(config("status.error"), $validate->getError());
        }

        //业务添加
        $category = new CategoryBus();
        try {
            $result = $category->add($data);
        }catch (\Exception $e){
            return show(config("status.error"), $e->getMessage());
        }

        return show(config("status.success"), "ok");
    }

    /**排序
     * @return \think\response\Json
     */
    public function listorder() {
        $id = input("param.id", 0, "intval");
        $listorder = input("param.listorder", 0, "intval");
        //todo 验证机制
        if (!$id) {
            return show(config('status.error'), "参数错误");
        }

        try {
            $res = (new CategoryBus())->listorder($id, $listorder);
        } catch (\Exception $e) {
            return show(config('status.error'), $e->getMessage());
        }

        if ($res) {
            return show(config('status.success'), "排序成功");
        }else{
            return show(config('status.error'), "排序失败");
        }
    }

    public function status()  {
        $status = input("param.status", 0, "intval");
        $id = input("param.id", 0, "intval");
        //todo 验证
        if(!$id || !in_array($status, Status::getTableStatus())){
            return show(config('status.error'), "参数错误");
        }

        try {
            $res = (new CategoryBus())->status($id, $status);
        } catch (\Exception $e) {
            return show(config('status.error'), $e->getMessage());
        }

        if ($res) {
            return show(config('status.success'), "状态更新成功");
        }else{
            return show(config('status.error'), "状态更新失败");
        }
    }


}
