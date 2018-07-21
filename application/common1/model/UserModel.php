<?php
/**
 * Created by PhpStorm.
 * User: Skyline
 * Date: 2018/4/1
 * Time: 0:33
 */
namespace app\common\model;

use think\Model;

class UserModel extends Model {

    protected $table = 'mc_user_auth';

    public static function getbyU($username) {
        return self::get(function ($query) use ($username) {
            $query->where('username',$username);
        });
    }

    public static function addOne($data) {
        return self::create($data);
    }
}