<?php

namespace app\admins\controller;


class Home extends Base
{
    public  function  index()
    {
        return $this->view->fetch();
    }
}