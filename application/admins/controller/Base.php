<?php

namespace app\admins\controller;


use think\Controller;
use think\facade\Session;
use Util\SysDb;

class Base extends  Controller
{
    public  function __construct()
    {
        parent::__construct();

        $admin=Session::get('admin');

        if(!$admin)
        {
            header('Location:/index.php/admins/Login/index');
            exit;
        }

        $this->view->admin=$admin;

        $sysDb=new SysDb();
    }
}