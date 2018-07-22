<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    "[api/yggdrasil/authserver]" => [
        "authenticate" => ["Authserver/authenticate"],
        "refresh" => ["Authserver/refresh"],
        "validate" => ["Authserver/validate"],
        "invalidate" => ["Authserver/invalidate"],
        "signout" => ["Authserver/signout"],
    ],
];
