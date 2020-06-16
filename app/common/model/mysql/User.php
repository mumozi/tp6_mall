<?php


namespace app\common\model\mysql;


use think\Model;

class User extends Model
{

    /**自动生成写入时间
     * @var bool
     */
    protected $autoWriteTimestamp = true;
    /**
     * 根据手机号获取用户表的数据
     * @param $phoneNumber
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUserByPhoneNumber($phoneNumber) {
        if (empty($phoneNumber)) {
            return false;
        }

        $where = [
            "phone_number" => trim($phoneNumber),
        ];

        $result = $this->where($where)->find();
        return $result;
    }

    /**通过ID获取用户数据
     * @param $id
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUserById($id){
        $id = intval($id);
        if (!$id) {
            return false;
        }
        return $this->find($id);
    }

    /**
     * @param $username
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUserByUsername($username){
        if (empty($username)) {
            return false;
        }
        $where = [
            'username' => $username,
        ];

        return $this->where($where)->find();
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