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

        iceLog($data);
        iceLog($accessToken);
        $userInfo = UserServer::checkUser($data['username'],$data['password']);
        if ($userInfo == -2) {
            return iceErrorJson(UserServer::$err);
        }

        iceLog($userInfo);

        $profiles = UserServer::getAvailableProfiles($userInfo['id']);
        if (false == $profiles) {
            $profiles = array(

            );
        }

        iceLog($profiles);

        return iceErrorJson();
    }


}