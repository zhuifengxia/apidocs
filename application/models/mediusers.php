<?php
class Mediusers extends Zend_Db_Table
{
	protected $_name='medi_users';
    protected $_primary='Medi_UserID';//用户表
    
    //用户登陆方法
    public function userlogin($username,$userpwd)
    {
    	try 
    	{
    		 $adminModel=new Mediusers();
    		 $db=$adminModel->getAdapter();
	    	 $where = "SELECT * FROM medi_users WHERE Medi_UserName='".$username."' AND Medi_UserPwd='".md5($userpwd)."'";
	         $result=$db->query($where)->fetchAll();
	         return  $result[0];
    	}
    	catch (Exception $e)//查询出错就返回-1；
    	{
    		return  -1;
    	}
    }
    
    //得到所有权限用户列表
    public function getuserlst()
    {
    	$adminModel=new Mediusers();
   		$where="Medi_Level=0";
   		$adminlst=$adminModel->fetchAll($where)->toArray();
   		return $adminlst;
    }
    
    //用户信息存储
    public function usereditsave($userid,$username,$userpwd)
    {
    	$adminModel=new Mediusers();
    	if($userid=="")//说明是添加
    	{
    		$data=array(
    			'Medi_UserName'=>$username,
    			'Medi_UserPwd'=>md5($userpwd),
    			'Medi_TruePwd'=>$userpwd
    		);
    		$adminModel->insert($data);	
    	}
    	else 
    	{
    		$data=array(
    			'Medi_UserName'=>$username,
    			'Medi_UserPwd'=>md5($userpwd),
    			'Medi_TruePwd'=>$userpwd
    		);
    		$where="Medi_UserID=".$userid;
    		$adminModel->update($data,$where);
    	}
    }
}
