<?php


namespace app\common\model\mysql;


use think\Model;

class AdminUser extends Model
{
    /**
     * 根据用户名获取后端表的数据
     * @param $username
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminUserByUsername($username) {
        if (empty($username)) {
            return false;
        }

        $where = [
            "username" => trim($username),
        ];

        $result = $this->where($where)->find();
        return $result;
    }

    /**更新信息
     * @param $id
     * @param $data
     * @return AdminUser|bool
     */
    public function updateById($id, $data) {
        $id = intval($id);
        if (empty($id) || empty($data) || !is_array($data)) {
            return false;
        }

        $where = [
            'id' => $id,
        ];

        return $this->where($where)->save($data);
    }

}