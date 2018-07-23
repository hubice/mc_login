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
            $map['uuid'] = UUIDServer::generate()->clearDashes();;
            $map['name'] = explode('@',$data['username'])[0];
            $profiles = UserServer::cratePrifiles($map);
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

    /**
     * @return \think\response\Json
     * token刷新
     */
    public function refresh(){
        iceLog("---token刷新---");
        $data = input('param.');
        iceLog($data);
        if (empty($data['accessToken'])) {
            return iceErrorJson();
        }
        $accessToken = UUIDServer::generate()->clearDashes();

        $userInfo = UserServer::checkToken($data['accessToken']);
        if (false === $userInfo) {
            return iceErrorJson(UserServer::$err);
        }
        $data['clientToken'] = $data['clientToken'] ? $data['clientToken'] : $userInfo['access_token'];
        UserServer::upAccessToken($userInfo['id'],array(
            'access_token' => $accessToken,
            'client_token' => $data['clientToken']
        ));

        $profiles = UserServer::getAvailableProfiles($userInfo['id']);
        if (empty($profiles)) {
            return iceErrorJson("角色数据异常");
        }

        $res = [];
        $res['accessToken'] = $accessToken;
        $res['clientToken'] = $data['clientToken'];
        $res['selectedProfile'] = UserServer::serializePro($profiles);
        $data['requestUser'] && ($res['user'] = UserServer::serializeUser($userInfo));
        iceLog($res);
        return json($res);
    }

    /**
     * @return \think\response\Json
     * 验证token是否正确
     */
    public function validates() {
        iceLog("---验证token是否正确---");
        $data = input('param.');
        iceLog($data);

        if (empty($data['accessToken']) || empty($data['clientToken'])) {
            return iceErrorJson();
        }
        $userInfo = UserServer::checkToken($data['accessToken']);
        if (false === $userInfo) {
            return iceErrorJson(UserServer::$err);
        }
        iceLog("No Content");
        return json('No Content',204);
    }

    /**
     * @return \think\response\Json
     * 清空单个token
     */
    public function invalidate() {
        $data = input('param.');
        iceLog("---清空单个token---");
        iceLog($data);
        if (empty($data['accessToken'])) {
            return iceErrorJson();
        }
        $userInfo = UserServer::checkToken($data['accessToken']);
        if (false === $userInfo) {
            return iceErrorJson(UserServer::$err);
        }
        $data['clientToken'] = $data['clientToken'] ? $data['clientToken'] : $userInfo['clientToken'];

        UserServer::upAccessToken($userInfo['id'],array(
            'access_token' => "",
            'client_token' => $data['clientToken']
        ));
        iceLog("No Content");
        return json('No Content',204);
    }

    /**
     * @return \think\response\Json
     * 登出 清空所有token
     */
    public function signout(){
        iceLog("---清空所有token---");
        return $this->invalidate();
    }
}