<?php
namespace Admin\Model;

use Think\Model\ViewModel;

class UserModel extends ViewModel
{
    public $viewFields = array(
        'admins' => array('id', 'name', 'username', 'lip', 'ldate', 'cip', 'mid', 'tel', 'email', 'dpt'),
        'role' => array('name' => 'rolename', '_on' => 'role.id=admins.mid'),
        'role_user' => array( '_on' => 'role_user.user_id=admins.id and role_user.role_id=role.id'),
    );

}