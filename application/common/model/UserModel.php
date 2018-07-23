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

    public static function addOne($data) {
        return self::create($data);
    }

    public static function getByUuid($uuid){
        return self::get(function($query) use ($uuid){
            $query->where('uuid', $uuid);
        });
    }

    public static function getIdByNames($inNames) {
        return self::field('name,uuid')->where('name','in',$inNames)->select();
    }
}