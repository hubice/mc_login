<?php
/**
 * Created by PhpStorm.
 * User: Skyline
 * Date: 2018/7/22
 * Time: 15:40
 */

namespace app\index\controller;

use think\Cache;
use think\Controller;

Class Index extends Controller {

    /**
     * @return \think\response\Json
     * 添加认证服务器接口
     */
    public function index() {
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

}
