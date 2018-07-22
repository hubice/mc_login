<?php
/**
 * Created by PhpStorm.
 * User: Skyline
 * Date: 2018/7/22
 * Time: 15:51
 */
namespace app\index\controller;

use app\common\server\UserServer;
use app\common\server\UUIDServer;
use think\Controller;

Class Authserver extends Controller {

    /**
     * 用户登陆认证接口
     */
    public function authenticate() {
        iceLog("---用户登陆认证接口---");
        $data = input('param.');
        iceLog($data);
//        $data['agent'] =   array (
//            'name' => 'Minecraft',
//            'version' => 1,
//        );
//        $data['password'] = '123456';
//        $data['clientToken'] = '83106648ff824745ac361f68ce36d13b';
//        $data['requestUser'] = true;
//        $data['username'] = 'demo@ice.com';

        if (empty($data['username']) || empty($data['password'])
            || empty($data['agent']))
        {
            return iceErrorJson();
        }
        $data['clientToken'] = $data['clientToken'] ? $data['clientToken'] : UUIDServer::generate()->clearDashes();
        $accessToken = UUIDServer::generate()->clearDashes();

        $userInfo = UserServer::checkUser(trim($data['username']),trim($data['password']));
        if (is_numeric($userInfo) && $userInfo == -2) {
            return iceErrorJson(UserServer::$err);
        }

        if (is_numeric($userInfo) && $userInfo == -1) {
            // 创建用户
            $map = [];
            $map['uuid'] = UUIDServer::generate(5, $data['username'], UUIDServer::NS_DNS)->clearDashes();
            $map['username'] = $data['username'];
            $map['client_token'] = $data['clientToken'];
            $map['password'] = $data['password'];
            $map['access_token'] = $accessToken;
            $userInfo = UserServer::crateUser($map);
            if (false === $userInfo) {
                return iceErrorJson(UserServer::$err);
            }
        } else {
            $map = [];
            $map['client_token'] = $data['clientToken'];
            $map['access_token'] = $accessToken;
            UserServer::upAccessToken($userInfo['id'],$map);
        }

        $profiles = UserServer::getAvailableProfiles($userInfo['id']);
        if (false == $profiles) {
            // 创建默认角色
            $map = [];
            $map['uid'] = $userInfo['id'];
            $_uuid = UUIDServer::generate(5, $data['username'],UUIDServer::NS_DNS);
            $map['uuid'] = (string)_uuid;
            $map['name'] = explode('@',$data['username'])[0];
            $profiles = UserServer::cratePrifiles($map,$_uuid->clearDashes());
            if (false === $profiles) {
                return iceErrorJson(UserServer::$err);
            }
        }

        $res = [];
        $res['accessToken'] = $accessToken;
        $res['clientToken'] = $data['clientToken'];
        $res['availableProfiles'] = [
            UserServer::serializePro($profiles)
        ];
        $res['selectedProfile'] = UserServer::serializePro($profiles);
        $data['requestUser'] && ($res['user'] = UserServer::serializeUser($userInfo));

        iceLog($res);
        return json($res);
    }


}