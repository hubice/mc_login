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

    protected $table = 'mc_user';

    public static function getId($id) {
        return self::get(function($query) use ($id){
            $query->where('uid', $id);
        });
    }
}