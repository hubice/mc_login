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
    "[authserver]" => [
        "authenticate" => ["Authserver/authenticate"],
        "refresh" => ["Authserver/refresh"],
        "validate" => ["Authserver/validates"],
        "invalidate" => ["Authserver/invalidate"],
        "signout" => ["Authserver/signout"],
    ],
    "[sessionserver]" => [
        "session/minecraft/join" => ["Session/join"],
        "session/minecraft/hasJoined" => ["Session/hasJoined"],
        "session/minecraft/profile" => ["Session/profile"],

    ],
    "/api/profiles/minecraft" => ["Session/profiles"]
];
