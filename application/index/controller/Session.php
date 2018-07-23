<?php
/**
 * Created by PhpStorm.
 * User: Skyline
 * Date: 2018/7/23
 * Time: 0:41
 */
namespace app\index\controller;

use app\common\server\UserServer;
use think\Cache;
use think\Controller;

class Session extends Controller
{
    public function join() {
        $data = input('param.');
        if (empty($data['accessToken']) || empty($data['selectedProfile']) || empty($data['serverId'])) {
            return iceErrorJson();
        }
        $userInfo = UserServer::checkToken($data['accessToken']);
        if (false === $userInfo) {
            return iceErrorJson(UserServer::$err);
        }
        $userPro = UserServer::getAvailableProfiles($userInfo['id']);
        if ($userPro['uuid'] != $data['selectedProfile']) {
            return iceErrorJson("角色数据异常");
        }
        Cache::set($data['serverId'],array(
            'username' => $userPro['name'],
            'token' => $data['accessToken']
        ),60);
        return json("No Content",204);
    }

    public function hasJoined() {
        $data = input('param.');
        if (empty($data['username']) || empty($data['serverId'])) {
            return iceErrorJson();
        }
        $sess = Cache::get($data['serverId']);
        if ($sess && $sess['username'] == $data['username']) {
            return json('ok');
        } else {
            return iceErrorJson("登陆失效");
        }
    }

    public function profile() {
        $data = input('param.');
        if (empty($data['uuid'])) {
            return iceErrorJson();
        }
        $userPro = UserServer::getProfilesByUuid($data['uuid']);
        if (false === $userPro) {
            return iceErrorJson(UserServer::$err);
        }
        $res = UserServer::serializePro($userPro);
        return json($res);
    }

    public function profiles() {
        $data = input('param.');
        if (count($data) < 2) {
            return iceErrorJson();
        }
        $all = [];
        foreach ($data as $v) {
            if (!empty($v)) {
                $all[] = $v;
            }
        }
        $res = UserServer::getIdByNames($all);
        return json($res);
    }
}