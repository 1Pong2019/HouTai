<?php

namespace app\admins\controller;


use think\Controller;

class Admins extends Controller
{
    public  function  index()
    {
        return $this->view->fetch();
    }
}