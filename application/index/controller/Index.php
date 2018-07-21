<?php
namespace app\index\controller;

class Index
{
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
     * 加入服务器
     */
    public function join() {
        $accessToken = input('accessToken','','trim');
        $selectedProfile = input('selectedProfile','','trim');
        $serverId = input('serverId','','trim');

        if (empty($accessToken) || empty($serverId) || empty($selectedProfile)) {
            return json(array(
                'error' => "Requested range not satisfiable",
                'errorMessage' => "参数错误",
                'cause' => ''
            ),416);
        }


    }
}
