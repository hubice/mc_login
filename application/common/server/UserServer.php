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
        $textures_skin->url = "https://mc.pan233.com/textures/skin/e490673ccdf61b95.png";
        $textures_skin->metadata = $textures_skin_metadata;
        $textures_cape = new \stdClass();
        $textures_cape->url = "https://mc.pan233.com/textures/cape/72ee2cfcefbfc081.png";
        $textures = new \stdClass();
        $textures->SKIN = $textures_skin;
        $textures->CAPE = $textures_cape;
        $text = new \stdClass();
        $text->timestamp = time()*1000;
        $text->profileId = $data['uuid'];
        $text->profileName = $data['name'];
        $text->textures = $textures;


        $data['create_time'] = $data['update_time'] = time();
        $data['status'] = 1;
        $data['properties'] = [
            [
                'name' => 'textures',
                'value' => base64_encode(json_encode($text,JSON_UNESCAPED_SLASHES | JSON_FORCE_OBJECT))
            ]
        ];

        $key = openssl_pkey_get_private('-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----');

        foreach ($data['properties'] as &$prop) {
            $signature = self::sign($prop['value'], $key);
            $prop['signature'] = base64_encode($signature);
        }
        $data['properties'] = json_encode($data['properties']);
        var_dump($data['properties']);
        die;


        $res = UserModel::addOne($data);
        if (empty($res)) {
            self::$err = "添加失败";
            return false;
        }
        $res['properties'] = json_decode($res['properties'],true);
        return $res;
    }

    private static function sign($data, $key)
    {
        openssl_sign($data, $sign, $key);
        return $sign;
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