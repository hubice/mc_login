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
            ),
            "signaturePublickey" => config('mclogin.public_key')
        ));
    }

    public function debug() {
        $str = "eyJTS0lOIjp7InVybCI6Imh0dHBzOlwvXC9tYy5wYW4yMzMuY29tXC90ZXh0dXJlc1wvc2tpblwvZTQ5MDY3M2NjZGY2MWI5NS5wbmciLCJtZXRhZGF0YSI6eyJtb2RlbCI6ImRlZmF1bHQifX0sIkNBUEUiOnsidXJsIjoiaHR0cHM6XC9cL21jLnBhbjIzMy5jb21cL3RleHR1cmVzXC9jYXBlXC83MmVlMmNmY2VmYmZjMDgxLnBuZyJ9fQ==";
        var_dump(json_decode(base64_decode($str)));

        $str2 = "eyJ0aW1lc3RhbXAiOjE1MzIzMjYxNzI4NjgsInByb2ZpbGVJZCI6ImYyNTNiNWY5MDgxZTQ3N2ZhNWRhY2I4MjhlNTZkMTYwIiwicHJvZmlsZU5hbWUiOiJjaGFyYWN0ZXIxIiwidGV4dHVyZXMiOnsiU0tJTiI6eyJ1cmwiOiJodHRwczovL2V4YW1wbGUueWdnZHJhc2lsLnl1c2hpLm1vZS90ZXh0dXJlcy9kODAzYWQzZTYyYTE2NzU4M2U5MmZkNWNhNGNkNGU5MWU4MjkyY2FlMmUyYjA2YmI4NmJiMjk0YTc4MTM4MDhlIiwibWV0YWRhdGEiOnsibW9kZWwiOiJkZWZhdWx0In19LCJDQVBFIjp7InVybCI6Imh0dHBzOi8vZXhhbXBsZS55Z2dkcmFzaWwueXVzaGkubW9lL3RleHR1cmVzLzU5ZDlmNDMxZGQ5ZTVjOTVlMzhhMjcxODcwMjI1MWVkOGJkNGUyOWU0MTg2YjVkMmRlZWUzMTY3YTIzYjU0MmEifX19";
        var_dump(json_decode(base64_decode($str2)));
        die;
    }

}
