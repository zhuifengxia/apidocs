<?php
if(!isset($_SESSION)) 
{ 
    session_start();
}
require_once 'BaseController.php';
require_once APPLICATION_PATH.'/models/mediusers.php';//用户表数据信息
class AdminloginController extends BaseController
{
/*
创建时间：2014.5.19
创建人：刘单风
内容主题：管理员后台
*/
	public function loginAction()
    {
        session_start();
        session_destroy();
    }
	//管理员登陆
    public function admininfoAction()
    {
    	session_start();
    	if(!empty($_SESSION['login']))
    	{
    		$this->render('index');
    	}
    	else
    	{
	        $name = $this->getRequest()->getParam("txtName");//用户登陆名
	        $pwd = $this->getRequest()->getParam("txtPwd");//用户密码
	        $adminModel=new Mediusers();
	        $result=$adminModel->userlogin($name,$pwd);//查询数据方法
	        if (!empty($result))
	        {
	        	
	        	$_SESSION['login'] =$result;
	        	$this->view->loginuser=$_SESSION['login'];
	        	$this->render('index');        	
	        }
	        else 
	        {
	        	echo "<script>alert('用户名或密码错误');</script>";
	        	$this->render('login');
	        }
    	}
    }
}