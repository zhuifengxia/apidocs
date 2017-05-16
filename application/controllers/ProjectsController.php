<?php
if(!isset($_SESSION)) 
{ 
    session_start();
}
if (empty($_SESSION['login']))
{
   echo "<script type='text/javascript'>window.location.href='/Adminlogin/login';</script>";
   exit();
}
require_once 'BaseController.php';
require_once APPLICATION_PATH.'/models/mediproject.php';//项目管理表
require_once APPLICATION_PATH.'/models/medicompetence.php';//权限管理表
require_once APPLICATION_PATH.'/models/mediusers.php';//用户表
class ProjectsController extends BaseController
{
/*
创建时间：2014.5.19  下午
创建人：刘单风
内容主题：项目管理
*/
	
	//项目管理列表页面
    public function projectlstAction()
    {
    	$projectModel=new Mediproject();
    	$selname=$this->getRequest()->getParam('selname');
    	if($_SESSION['login']['Medi_Level']=="1")
    	{
    		$userid=0;//如果是管理员登陆就传过去一个0进行标示查询出所有项目列表
    	}
    	else
    	{
    		$userid=$_SESSION['login']['Medi_UserID'];//说明是权限用户，只加载可见项目列表
    	}
    	$projectlst=$projectModel->getprojectlst($userid,$selname);
    	if(count($projectlst)<=0)
    	{
    		$this->view->result="暂无项目数据！";
    	}
    	$this->view->projectlst=$projectlst;//项目列表返回页面
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    	$this->view->selname=$selname;//查询字符串返回到页面中
    }
    
    //项目编辑/添加页面
    public function projecteditAction()
    {
    	$edittype=$this->getRequest()->getParam('edittype');//编辑还是添加
    	if($edittype==1)//编辑
    	{
    		$projectid=$this->getRequest()->getParam('projectid');//项目ID
	    	$projectModel=new Mediproject();
	    	$projectdetail=$projectModel->getprojectdetail($projectid);//获取项目详细信息
	    	$this->view->projectdetail=$projectdetail;
    	}
    	$this->view->edittype=$edittype;
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    }
    
    //项目编辑/添加页面保存
    public function projecteditsaveAction()
    {
    	$edittype=$this->getRequest()->getParam('edittype');//编辑还是添加
    	$projectModel=new Mediproject();
    	if($edittype==0)//添加
    	{
    		$projectname=$this->getRequest()->getParam('projectname');//项目名称
    		$projectjoin=$this->getRequest()->getParam('projectjoin');//项目参与人
    		$projectinfo=$this->getRequest()->getParam('projectinfo');//项目简介
    		$data=array(
    			'Medi_ProjectName'=>$projectname,
    			'Medi_ProjectJoin'=>$projectjoin,
    			'Medi_ProjectInfo'=>$projectinfo
    		);
    		$where="";
    		$msg="添加成功！";
    	}
    	else//编辑
    	{
    		$projectid=$this->getRequest()->getParam('projectid');//项目ID
    		$projectname=$this->getRequest()->getParam('projectname');//项目名称
    		$projectjoin=$this->getRequest()->getParam('projectjoin');//项目参与人
    		$projectinfo=$this->getRequest()->getParam('projectinfo');//项目简介
    		$data=array(
    			'Medi_ProjectName'=>$projectname,
    			'Medi_ProjectJoin'=>$projectjoin,
    			'Medi_ProjectInfo'=>$projectinfo
    		);
    		$where="Medi_ProjectID=".$projectid;
    		$msg="修改成功！";
    	}
    	$projectModel->projecteditsave($data,$where);
    	echo "<script>alert('".$msg."'); window.location.href='/Projects/projectlst';</script>";
   		exit();
    }
    
    //权限列表页面
    public function competencelstAction()
    {
    	$competModel=new Medicompetence();
    	$competencelst=$competModel->competencelst();//查询找出权限的所有数据列表
    	if(count($competencelst)<=0)
    	{
    		$this->view->result="暂无项目数据！";
    	}
    	$this->view->competencelst=$competencelst;
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    }
    
    //权限管理编辑/添加页面
    public function competenceditAction()
    {
   		$edittype=$this->getRequest()->getParam('edittype');//编辑还是添加
    	if($edittype==1)//编辑
    	{
    		$competenceid=$this->getRequest()->getParam('competenceid');//权限ID
	    	$competModel=new Medicompetence();
	    	$competencedetail=$competModel->getcompetencedetail($competenceid);//获取权限数据详细信息
	    	$this->view->competencedetail=$competencedetail;
    	}
    	//获取所有项目列表
    	$projectModel=new Mediproject();
    	$projectlst=$projectModel->getprojectlst(0,"");
    	//获取所有权限用户
    	$userModel=new Mediusers();
    	$userlst=$userModel->getuserlst();
    	$this->view->userlst=$userlst;
    	$this->view->projectlst=$projectlst;
    	$this->view->edittype=$edittype;
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    }
    
    //权限管理编辑/添加保存页面
    public function competenceditsaveAction()
    {
    	$edittype=$this->getRequest()->getParam('edittype');//编辑还是添加
    	$projectModel=new Medicompetence();
    	if($edittype==0)//添加
    	{
    		$userid=$this->getRequest()->getParam('userid');//用户ID
    		$projectid=$this->getRequest()->getParam('seeproject');//可见项目ID
    		$msg="添加成功！";
    	}
    	else//编辑
    	{
    		$compeid=$this->getRequest()->getParam('competenid');//权限ID
    		$projectid=$this->getRequest()->getParam('seeproject');//项目ID
    		$userid=$this->getRequest()->getParam('huserid');//用户ID
    		$msg="修改成功！";
    	}
    	$result=$projectModel->competenceditsave($projectid,$compeid,$userid);
    	if($result==2)
    	{
    		$msg="该用户已经拥有对该项目的查看权限！";
    	}
    	echo "<script>alert('".$msg."'); window.location.href='/Projects/competencelst';</script>";
   		exit();
    }
    
    //权限删除
    public function competencedelAction()
    {
    	$compeid=$this->getRequest()->getParam('competenceid');//权限ID
    	$compeModel=new Medicompetence();
    	$where="Medi_CompetenceID=".$compeid;
    	$compeModel->delete($where);
    	echo "<script>alert('删除成功！'); window.location.href='/Projects/competencelst';</script>";
   		exit();
    }
    
    //用户列表页面
    public function userlstAction()
    {
    	//获取所有权限用户
    	$userModel=new Mediusers();
    	$userlst=$userModel->getuserlst();
    	if(count($userlst)<=0)
    	{
  			$this->view->result="暂无用户数据！";
    	}
    	$this->view->userlst=$userlst;
   		$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    }
    
    //用户编辑/保存页面
    public function usereditAction()
    {
    	$userModel=new Mediusers();
    	$edittype=$this->getRequest()->getParam('edittype');//编辑还是添加
    	if($edittype==1)//编辑
    	{
    		$userid=$this->getRequest()->getParam('userid');//权限ID
    		$where="Medi_UserID=".$userid;
    		$userdetail=$userModel->fetchAll($where)->toArray();
	    	$this->view->userdetail=$userdetail[0];
    	}
    	$this->view->edittype=$edittype;
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    }
    //用户编辑/添加保存页面
    public function usereditsaveAction()
    {
    	$userModel=new Mediusers();
    	$edittype=$this->getRequest()->getParam('edittype');//编辑还是添加
    	if($edittype==0)//添加
    	{
    		$username=$this->getRequest()->getParam('username');//用户名
    		$userpwd=$this->getRequest()->getParam('userpwd');//用户密码
    		$msg="添加成功！";
    	}
    	else//编辑
    	{
    		$userid=$this->getRequest()->getParam('userid');//用户ID
    		$username=$this->getRequest()->getParam('username');//用户名
    		$userpwd=$this->getRequest()->getParam('userpwd');//用户密码
    		$msg="修改成功！";
    	}
    	$result=$userModel->usereditsave($userid,$username,$userpwd);
    	echo "<script>alert('".$msg."'); window.location.href='/Projects/userlst';</script>";
   		exit();
    }
    
    //用户删除
    public function userdelAction()
    {
    	$userModel=new Mediusers();
    	$userid=$this->getRequest()->getParam('userid');//用户ID
    	$where="Medi_UserID=".$userid;
    	$userModel->delete($where);
    	echo "<script>alert('删除成功！'); window.location.href='/Projects/userlst';</script>";
   		exit();
    }
}