<?php
class Mediproject extends Zend_Db_Table
{
	protected $_name='medi_project';
    protected $_primary='Medi_ProjectID';//项目表
    
    //根据当前登录人的权限来显示项目列表
    public function getprojectlst($userid,$selname)
    {
    	$projectModel=new Mediproject();
    	$db=$projectModel->getAdapter();
    	$sql="SELECT * FROM medi_project WHERE 1=1";
    	if($userid!=0)//说明不是管理员登陆，列出该用户可见项目
    	{
    		$sql.=" AND Medi_ProjectID IN(SELECT Medi_VisibleProject FROM medi_competence WHERE Medi_UserID=".$userid.")";
    	}
    	if($selname!=""&&$selname!="项目名称/参与人/项目简介")
   		{
   			$sql.=" AND (Medi_ProjectName LIKE '%".$selname."%' OR Medi_ProjectJoin LIKE '%".$selname."%' OR Medi_ProjectInfo LIKE '%".$selname."%')";
   		}
    	$result=$db->query($sql)->fetchAll();
    	return $result;
    }
    
    //根据项目名称得到该项目的详细信息
    public function getprojectdetail($proid)
    {
    	$projectModel=new Mediproject();
    	$db=$projectModel->getAdapter();
    	$sql="SELECT * FROM medi_project WHERE Medi_ProjectID=".$proid." LIMIT 1";
    	$prodetail=$db->query($sql)->fetchAll();
    	return $prodetail[0];
    }
    
    //项目名称的修改或者添加
    public function projecteditsave($data,$where)
    {
    	$projectModel=new Mediproject();
    	if($where=="")//说明是添加
    	{
    		$projectModel->insert($data);
    	}
    	else
    	{
    		
    		$projectModel->update($data,$where);
    	}
    }
}
