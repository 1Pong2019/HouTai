<?php

namespace app\admins\controller;


use think\Controller;
use think\facade\Request;
use think\facade\Session;
use Util\SysDb;

class Login extends Controller
{
    public  function  index()
    {
        return $this->view->fetch();
    }

    public  function  doLogin()
    {
        $data=Request::param();

        if($data['username'] == ''){
            return json_encode(['code'=>1,'msg'=>'用户名不能为空']);
        }
        if($data['password'] == ''){
            return json_encode(['code'=>1,'msg'=>'密码不能为空']);
        }
        if($data['vertify']==''){
            return json_encode(['code'=>1,'msg'=>'验证码不能为空']);
        }
        if(!captcha_check($data['vertify'])){
            return json_encode(['code'=>1,'msg'=>'验证码不正确']);
        }

        $sysDb=new SysDb();

        $res=$sysDb->table('admins')->where(['username'=>$data['username']])->item();

        //验证用户名
        if(!$res)
        {
            return json_encode(['code'=>1,'msg'=>'用户名不存在']);
        }

        //验证密码
        if($res['password']!=md5($data['password']))
        {
            return json_encode(['code'=>1,'msg'=>'密码错误']);
        }
        //验证用户是否被禁用
        if($res['status']==1)
        {
            return json_encode(['code'=>1,'msg'=>'用户已被禁用，不允许登录']);
        }

        Session::set('admin',$res);

        return json_encode(['code'=>0,'msg'=>'登录成功']);
    }
}