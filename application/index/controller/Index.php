<?php
/**
 * Created by PhpStorm.
 * User: Skyline
 * Date: 2018/7/22
 * Time: 15:40
 */

namespace app\index\controller;

use think\Controller;

Class Index extends Controller {

    /**
     * @return \think\response\Json
     * 添加认证服务器接口
     */
    public function index() {

        $str = "eyJ0aW1lc3RhbXAiOjE1MzIyNjg4NjYsInByb2ZpbGVJZCI6IjY5NzU3OGVhMWIxYjVhMTZiMGEyM2ZkNDVkODU3MWMwIiwicHJvZmlsZU5hbWUiOiJkZW1vMTIzIiwidGV4dHVyZXMiOnsiU0tJTiI6eyJ1cmwiOiJodHRwczpcL1wvbWMucGFuMjMzLmNvbVwvdGV4dHVyZXNcL3NraW5cL2U0OTA2NzNjY2RmNjFiOTUucG5nIiwibWV0YWRhdGEiOnsibW9kZWwiOiJkZWZhdWx0In19LCJDQVBFIjp7InVybCI6Imh0dHBzOlwvXC9tYy5wYW4yMzMuY29tXC90ZXh0dXJlc1wvY3d3d2FwZVwvNzJlZTJjZmNlZmJmYzA4MS5wbmcifX19";

        var_dump(json_decode(base64_decode($str),true));
        die;
//        die;
//
//
//        return json(array(
//            "meta" => array(
//                "serverName" => "IceCraft",
//                "implementationName" => "IceCraft Admin",
//                "implementationVersion" => "1.0.0"
//            ),
//            "skinDomains" => array(
//                ".pan233.com"
//            )
//        ));
    }

}
