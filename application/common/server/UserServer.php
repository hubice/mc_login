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
        $userInfo['properties'] = json_decode($userInfo['properties'],true);
        return $userInfo;
    }

    public static function upAccessToken($id,$data) {
        $data['access_token_time'] = time() + 10 * 3600 * 24;
        $data['update_time'] = time();
        return UserAuthModel::upToken($id,$data);
    }

    public static function crateUser($data) {
        $data['create_time'] = $data['update_time'] = time();
        $data['access_token_time'] = time() + 10 * 3600 * 24;
        $data['status'] = 1;
        $data['properties'] = json_encode([
//                [
//                    "name" => 'preferredLanguage',
//                    "value" => 'zh_CN'
//                ]
            ]);
        $res = UserAuthModel::addOne($data);
        if (empty($res)) {
            self::$err = "添加失败";
            return false;
        }
        $res['properties'] = json_decode($res['properties'],true);
        return $res;
    }

    public static function getAvailableProfiles($userId)
    {
        $userPro = UserModel::getId($userId);
        if (empty($userPro)) {
            self::$err = "不存在";
            return false;
        }
        $userPro['properties'] = json_decode($userPro['properties'],true);
        return $userPro;
    }

    public static function cratePrifiles($data) {
        $textures_skin_metadata = new \stdClass();
        $textures_skin_metadata->model = "default";
        $textures_skin = new \stdClass();
        $textures_skin->url = "https://example.yggdrasil.yushi.moe/textures/d803ad3e62a167583e92fd5ca4cd4e91e8292cae2e2b06bb86bb294a7813808e";
        $textures_skin->metadata = $textures_skin_metadata;
        $textures_cape = new \stdClass();
        $textures_cape->url = "https://example.yggdrasil.yushi.moe/textures/59d9f431dd9e5c95e38a2718702251ed8bd4e29e4186b5d2deee3167a23b542a";
        $textures = new \stdClass();
        $textures->SKIN = $textures_skin;
        $textures->CAPE = $textures_cape;

        $data['create_time'] = $data['update_time'] = time();
        $data['status'] = 1;
        $data['properties'] = json_encode([
            [
                'name' => 'textures',
                'value' => base64_encode(json_encode($textures))
            ]
        ]);
        $res = UserModel::addOne($data);
        if (empty($res)) {
            self::$err = "添加失败";
            return false;
        }
        $res['properties'] = json_decode($res['properties'],true);
        return $res;
    }

    public static function serializeUser($userInfo) {
        return array(
            'id' => $userInfo['uuid'],
            'properties' => $userInfo['properties']
        );
    }

    public static function serializePro($userPro) {
        return array(
            'id' => $userPro['uuid'],
            'name' => $userPro['name'],
            'properties' => $userPro['properties']
        );
    }

    // token验证
    public static function checkToken($token) {
        $userInfo = UserAuthModel::getbyTokent($token);
        if (empty($userInfo)) {
            self::$err = "数据为空";
            return false;
        }
        if ($userInfo['access_token_time'] < time()) {
            self::$err = "过期了";
            return false;
        }
        return $userInfo;
    }

    public static function getProfilesByUuid($uuid){
        $userPro = UserModel::getByUuid($uuid);
        if (empty($userPro)) {
            self::$err = "不存在";
            return false;
        }
        $userPro['properties'] = json_decode($userPro['properties'],true);
        return $userPro;
    }

    public static function getIdByNames($data) {
        $userInfo = UserModel::getIdByNames(implode(',',$data));
        $res =[];
        foreach ($userInfo as $v) {
            $res[] = array(
                'id' => $v['uuid'],
                'name' => $v['name'],
            );
        }
        return $res;
    }
}