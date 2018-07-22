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

        $data['password'] = '123456';
        $data['clientToken'] = 'd5a4513263c34768ba6a90848af82038';
        $data['requestUser'] = true;
        $data['username'] = 'demo@ice.com';
        $data['agent'] = array(
            'v' => 2
        );

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
        iceLog($userInfo);

        if (is_numeric($userInfo) && $userInfo == -2) {
            return iceErrorJson(UserServer::$err);
        }

        $profiles = UserServer::getAvailableProfiles(1);
        if (false == $profiles) {
            $profiles = array(

            );
        }
        iceLog($profiles);

        return iceErrorJson();
    }


}