<?php
namespace app\index\controller;

use app\common\model\UserModel;

class Index
{
    /**
     * @return \think\response\Json
     * 加入认证服务器
     */
    public function index()
    {
        return json(array(
            "meta" => array(
                "serverName" => "IceCraft",
                "implementationName" => "IceCraft Admin",
                "implementationVersion" => "1.0.0"
            ),
            "skinDomains" => array(
                ".pan233.com"
            )
        ));
    }

    /**
     * 登陆获取token
     */
    public function authenticate() {
        $username = input('username','','trim');
        $password = input('password','','trim');
        $clientToken = input('clientToken','','trim');
        $requestUser = input('requestUser',false,'boolean');

        if (empty($username) || empty($password)) {
            return self::errJson();
        }
        if (!$clientToken) {
            $clientToken = self::unformatJavaUuid(self::constructOfflinePlayerUuid($username));
        }
        $userInfo = UserModel::getbyU($username);
        $map = [
            'availableProfiles' => [],
            'selectedProfile' => [],
            'user' => [],
        ];
        $map['clientToken'] = $clientToken;
        if (false) {
            // 存在用户
            // 1820120473@qq.com
            // woailuo115
        } else {
            $data = [];
            $data['username'] = $username;
            $data['password'] = $password;
            $data['clientToken'] = $clientToken;
            $data['accessToken'] = self::unformatJavaUuid(self::constructOfflinePlayerUuid(''.time().$username));
            $data['accessTokenTime'] = time() + 10 * 24 * 60 * 60;
            $id = UserModel::addOne($data);
            if (!$id) {
                return self::errJson("数据库加入失败！");
            }
            $map['accessToken'] = $data['accessToken'];
        }
        if ($requestUser) {
            // 处理用户数据
        }
        return json($map);
    }

    /**
     * 加入服务器
     */
    public function join() {
        $accessToken = input('accessToken','','trim');
        $selectedProfile = input('selectedProfile','','trim');
        $serverId = input('serverId','','trim');

        if (empty($accessToken) || empty($serverId) || empty($selectedProfile)) {
            return self::errJson();
        }


    }

    private static function errJson($msg = "参数错误") {
        return json(array(
            'error' => "Requested range not satisfiable",
            'errorMessage' => $msg,
            'cause' => ''
        ),416);
    }

    private static function unformatJavaUuid($uuid) {
        return str_replace('-','',$uuid);
    }

    private static function constructOfflinePlayerUuid($username) {
        $data = hex2bin(md5("OfflinePlayer:" . $username));
        $data[6] = chr(ord($data[6]) & 0x0f | 0x30);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return self::createJavaUuid(bin2hex($data));
    }

    private static function createJavaUuid($striped) {
        $components = array(
            substr($striped, 0, 8),
            substr($striped, 8, 4),
            substr($striped, 12, 4),
            substr($striped, 16, 4),
            substr($striped, 20),
        );
        return implode('-', $components);
    }

}
