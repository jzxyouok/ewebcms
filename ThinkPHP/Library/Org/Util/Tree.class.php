<?php
/**
 * Created by PhpStorm.
 * User: hezhaoyang
 * Date: 5/2/2015
 * Time: 10:56 PM
 */
namespace Org\Util;
class Tree{
    static public $treeList = array();

    public function create($data,$pid = 0){
        foreach($data as $key => $value){
            if($value['pid'] == $pid){
                self::$treeList[] = $value;
                unset($data[$key]);
                self::create($data,$value['id']);
            }
        }

        return self::$treeList;
    }

    public function treecreate($data,$fid = 0){
        foreach($data as $key => $value){
            if($value['fid'] == $fid){
                $value['chd'] = "222";
                unset($data[$key]);
                self::treecreate($data,$value['id']);
            }
        }

        return $data;
    }
}