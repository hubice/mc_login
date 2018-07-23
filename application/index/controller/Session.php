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
    /**
     * @return \think\response\Json
     * 客户端加入
     */
    public function join() {
        $data = input('param.');
        iceLog("---客户端加入---");
        iceLog($data);
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
            'token' => $data['accessToken'],
            'userId' => $userInfo['id']
        ),60);
        iceLog("No Content");
        return json("No Content",204);
    }

    /**
     * @return \think\response\Json
     * 服务的验证
     */
    public function hasJoined() {
        $data = input('param.');
        iceLog("---服务的验证---");
        iceLog($data);
        if (empty($data['username']) || empty($data['serverId'])) {
            return iceErrorJson();
        }
        $sess = Cache::get($data['serverId']);
        Cache::set($data['serverId'],'');
        if (empty($sess) || $sess['username'] != $data['username'] || empty($sess['userId'])) {
            return iceErrorJson("登陆失效");
        }
        $userPro = UserServer::getAvailableProfiles($sess['userId']);
        $res = UserServer::serializePro($userPro);
        iceLog($res);
        return json($res);
    }

    /**
     * @return \think\response\Json
     * 查找角色
     */
    public function profile() {
        $data = input('param.');
        iceLog("---查找角色---");
        iceLog($data);
        if (empty($data['uuid'])) {
            return iceErrorJson();
        }
        $userPro = UserServer::getProfilesByUuid($data['uuid']);
        if (false === $userPro) {
            return iceErrorJson(UserServer::$err);
        }
        $res = UserServer::serializePro($userPro);
        iceLog($res);
        return json($res);
    }

    /**
     * @return \think\response\Json
     * 批量找角色
     */
    public function profiles() {
        $data = input('param.');
        iceLog("---查找角色---");
        iceLog($data);
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
        iceLog($res);
        return json($res);
    }
}