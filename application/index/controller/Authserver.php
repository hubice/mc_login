<?php
/**
 * Created by PhpStorm.
 * User: Skyline
 * Date: 2018/7/22
 * Time: 15:51
 */
namespace app\index\controller;

use think\Controller;
use think\Log;

Class Authserver extends Controller {

    /**
     * 用户登陆认证接口
     */
    public function authenticate() {
        Log::record("用户登陆认证接口");
        $data = input('.post');
        Log::record($data);
        return errorJson();

    }


}