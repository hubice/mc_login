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
            $map['username'] = $data['username'];
            $map['client_token'] = $data['clientToken'];
            $map['password'] = $data['password'];
            $map['access_token'] = $accessToken;
            $userInfo = UserServer::crateUser($map);
            if (false === $userInfo) {
                return iceErrorJson(UserServer::$err);
            }
        }

        $profiles = UserServer::getAvailableProfiles(1);
        if (false == $profiles) {
            // 创建默认角色
            $map = [];
            $profiles = UserServer::cratePrifiles($map);
            if (false === $profiles) {
                return iceErrorJson(UserServer::$err);
            }
        }

        $res = [];
        $res['accessToken'] = $userInfo['access_token'];
        $res['clientToken'] = $userInfo['client_token'];
        $res['availableProfiles'] = null;
        $res['selectedProfile'] = null;
        $res['user'] = null;
        return json($res);
    }


}