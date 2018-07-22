<?php
/**
 * Created by PhpStorm.
 * User: Skyline
 * Date: 2018/7/22
 * Time: 16:53
 */
namespace app\common\server;

use app\common\model\UserAuthModel;
use app\common\model\UserModel;

Class UserServer {

    public static $err = "";

    public static function checkUser($username,$password) {
        $userInfo = UserAuthModel::getbyU($username);
        if (empty($userInfo)) {
            self::$err = "用户不存在";
            return -1;
        }
        if ($userInfo['password'] != $password) {
            self::$err = "密码不正确";
            return -2;
        }
        return $userInfo;
    }

    public static function crateUser($data) {
        $data['create_time'] = $data['update_time'] = time();
        $data['access_token_time'] = time() + 10 * 3600 * 24;
        $data['status'] = 1;
        $data['properties'] = json_encode(array('preferredLanguage' => 'zh_CN'));
        $res = UserAuthModel::addOne($data);
        if (empty($res)) {
            self::$err = "添加失败";
            return false;
        }
        return $res;
    }


    public static function getAvailableProfiles($userId)
    {
        $userPro = UserModel::getId($userId);
        if (empty($userPro)) {
            self::$err = "不存在";
            return false;
        }
        return $userPro;
    }

    public static function cratePrifiles($data) {
        return 123;
    }
}