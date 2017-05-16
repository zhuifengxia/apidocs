<?php
class Medicompetence extends Zend_Db_Table
{
	protected $_name='medi_competence';
    protected $_primary='Medi_CompetenceID';//权限管理表
    
    //得到权限管理列表
    public function competencelst()
    {
    	$competModel=new Medicompetence();
    	$db=$competModel->getAdapter();
    	$sql="SELECT c.Medi_CompetenceID,a.Medi_UserName,a.Medi_TruePwd,p.Medi_ProjectName FROM medi_users a,medi_project p,medi_competence c WHERE c.Medi_UserID=a.Medi_UserID AND p.Medi_ProjectID=c.Medi_VisibleProject";
    	$result=$db->query($sql)->fetchAll();
    	return $result;
    }
    
    //得到一个权限用户的详细数据
    public function getcompetencedetail($compid)
    {
    	$competModel=new Medicompetence();
    	$db=$competModel->getAdapter();
    	$sql="SELECT c.Medi_CompetenceID,c.Medi_VisibleProject,a.*,p.Medi_ProjectName FROM medi_users a,medi_project p,medi_competence c WHERE c.Medi_UserID=a.Medi_UserID AND p.Medi_ProjectID=c.Medi_VisibleProject AND c.Medi_CompetenceID=".$compid." LIMIT 1";
    	$result=$db->query($sql)->fetchAll();
    	return $result[0];
    }
    
    //权限管理模块添加/编辑
    public function competenceditsave($projectid,$compeid,$userid)
    {
    	$competModel=new Medicompetence();
    	$db=$competModel->getAdapter();
    	if($compeid=="")//说明是添加
    	{
    		$sesql="SELECT Medi_VisibleProject FROM medi_competence WHERE Medi_VisibleProject=".$projectid." AND Medi_UserID=".$userid." LIMIT 1";
    		$seldata=$db->query($sesql)->fetchAll();
    		if(count($seldata)<=0)//说明该用户还没有该项目的权限
    		{
    			$insql="INSERT INTO medi_competence(Medi_UserID,Medi_VisibleProject) VALUES(".$userid.",".$projectid.")";
    			$db->query($insql);
    			return 0;
    		}
    		else //说明该用户已经拥有对该项目的权限查看
    		{
    			return 2;
    		}
    	}
    	else//编辑
    	{
    		//修改权限表数据
    		$comsql="UPDATE medi_competence SET Medi_VisibleProject=".$projectid." WHERE Medi_CompetenceID=".$compeid;
    		$db->query($comsql);
    		return 0;
    	}
    }
}
