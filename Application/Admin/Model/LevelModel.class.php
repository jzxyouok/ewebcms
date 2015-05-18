<?php
namespace Admin\Model;

use Think\Model\ViewModel;

class LevelModel extends ViewModel
{
    public $viewFields = array(
        'admins' => array('id'),
        'roles' => array('doclevel', 'classlevel', 'messlevel', 'memblevel', '_on' => 'roles.id=admins.mid'),
    );

}