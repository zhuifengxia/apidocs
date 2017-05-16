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
require_once APPLICATION_PATH.'/models/medidatabase.php';//数据库文档列表
require_once APPLICATION_PATH.'/models/meditable.php';//数据表
require_once APPLICATION_PATH.'/models/medicontent.php';//表内容
class DataController extends BaseController
{
/*
创建时间：2014.6.18  下午
创建人：谢静
内容主题：数据库字典
*/
	
	//目标项目的数据库文档列表页面
    public function datalstAction()
    {
    	$dataModel=new Medidata();
    	$projectid=$this->getRequest()->getParam('projectid');//项目ID
    	$projectname=$this->getRequest()->getParam('projectname');//项目名称
    	$datalst=$dataModel->getdatalst($projectid);//获取目标项目的数据库字典列表
    	if(count($datalst)<=0)
    	{
    		$this->view->result="暂无数据！";
    	}
    	$this->view->datalst=$datalst;
    	$this->view->projectname=$projectname;//项目名称
    	$this->view->projectid=$projectid;//项目id
    	$this->view->loginuser=$_SESSION['login'];//用户信息
    }
    //新建数据库字典页面
     public function newdataAction()
     {
     	$projectid=$this->getRequest()->getParam('proid');//项目ID
     	$projectname=$this->getRequest()->getParam('proname');//项目名称
     	$this->view->loginuser=$_SESSION['login'];//用户信息
     	$this->view->projectname=$projectname;//项目名称
     	$this->view->projectid=$projectid;//项目id
     	$this->render('newdata');
     }
     //保存新建的数据库字典
     public function savenewdataAction()
     {
     	$projectid=$this->getRequest()->getParam('proid');//项目ID
     	$projectname=$this->getRequest()->getParam('proname');//项目名称
     	$dataname=$this->getRequest()->getParam('dataname');//数据库字典名称
     	$dataModel=new Medidata();
     	$now=date('Y-m-d H:i:s');
     	$data=array(
     			'Medi_DataName'=>$dataname,
     			'Medi_DataCreatName'=>$_SESSION['login']['Medi_UserName'],
     			'Medi_DataCreatTime'=>$now,
     			'Medi_DataUpdateName'=>$_SESSION['login']['Medi_UserName'],
     			'Medi_DataUpdateTime'=>$now,
     			'Medi_ProjectID'=>$projectid
     			);
     	$res=$dataModel->insert($data);
     	if($res!=-1){
     		header('content-type:text/html;charset=utf-8;');
     		echo "<script>alert('数据库字典添加成功');</script>";
     		echo "<script>window.location.href='/Data/datalst?projectid=$projectid&projectname=$projectname';</script>";
     		exit();
     	}
     }
    //查看数据库字典的数据表
    public function tablelstAction()
    {
    	$tableModel=new Meditable();
    	$id=$this->getRequest()->getParam('dataid');//数据库字典ID
    	$projectid=$this->getRequest()->getParam('projectid');//项目ID
    	$projectname=$this->getRequest()->getParam('projectname');//项目名称
    	$sum=$tableModel->tablecount($id);
    	$cpage=$this->getRequest()->getParam("cpage","");//当前页
    	if ($cpage==""){
    		$cpage=1;
    	}
    	$num=10;//每页显示数据表数
    	$page=ceil($sum/$num);//总页数
    	$start=($cpage-1)*$num;
    	$table=$tableModel->gettable($id,$start,$num);
    	if(count($table)<=0)
    	{
    		$this->view->result="暂无数据库表！";
    	}
    	$this->view->tablelst=$table;
        $this->view->lbcount=$sum;
        $this->view->cpage=$cpage;
        $this->view->spage=$page;
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    	$this->view->projectid=$projectid;//项目ID
    	$this->view->projectname=$projectname;//项目名称
    	$this->view->id=$id;
    }
    
    //数据表查看页面
    public function tablelookAction()
    {
    	$dataid=$this->getRequest()->getParam("dataid");//数据库字典ID
   		$projectid=$this->getRequest()->getParam('projectid');//项目ID
   		$projectname=$this->getRequest()->getParam('projectname');//项目名称
   		$tableid=$this->getRequest()->getParam("id");//数据表ID
   		$tableModel=new Meditable();
   		$detail=$tableModel->getdetail($tableid);//得到数据表的详细信息
   		//同时表内字段信息
   		$contentModel=new Medicontent();
   		$fields=$contentModel->getfields($tableid);//得到数据表内字段信息
   		$this->view->detail=$detail;
   		$this->view->fields=$fields;
   		$this->view->tableid=$tableid;
   		$this->view->dataid=$dataid;
   		$this->view->projectid=$projectid;//项目ID
   		$this->view->projectname=$projectname;//项目名称
   		//获取数据库字典名称
   		$dataModel=new Medidata();
   		$db=$dataModel->getAdapter();
   		$where=$db->quoteInto('Medi_DataID', $dataid);
   		$res=$dataModel->fetchAll($where)->toArray();
   		$this->view->dataname=$res[0]['Medi_DataName'];
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    }
    
    //数据表编辑/添加页面
    public function tableeditAction()
    {
    	$edittype=$this->getRequest()->getParam("edittype");//操作类型，0是添加，1编辑
    	$dataid=$this->getRequest()->getParam("dataid");//数据库字典ID
   		$projectid=$this->getRequest()->getParam('projectid');//项目ID
   		$projectname=$this->getRequest()->getParam('projectname');//项目名称
   		$dataModel=new Medidata();
   		$db=$dataModel->getAdapter();
   		$where=$db->quoteInto('Medi_DataID', $dataid);
   		$res=$dataModel->fetchAll($where)->toArray();
    	if($edittype==1)//说明是编辑数据表
    	{
    		$tableid=$this->getRequest()->getParam("id");//数据表ID
    		$tableModel=new Meditable();
    		$detail=$tableModel->getdetail($tableid);//得到数据表的详细信息
    		//同时表内字段信息
    		$contentModel=new Medicontent();
    		$fields=$contentModel->getfields($tableid);//得到数据表内字段信息
   			$this->view->detail=$detail;
    		$this->view->fields=$fields;
    		$this->view->tableid=$tableid;
    	}
    	$this->view->edittype=$edittype;
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    	$this->view->dataid=$dataid;
		$this->view->projectid=$projectid;//项目ID
		$this->view->projectname=$projectname;//项目名称
		$this->view->dataname=$res[0]['Medi_DataName'];
    }
    
    //数据表编辑/添加保存
    public function tablesaveAction()
    {
    	$dataid=$this->getRequest()->getParam("dataid");//数据库字典ID
    	$tableid=$this->getRequest()->getParam("tabid");//数据表ID
    	$projectid=$this->getRequest()->getParam('proid');//项目ID
    	$projectname=$this->getRequest()->getParam('proname');//项目名称
    	$name=$this->getRequest()->getParam('name');//数据表名称
    	$note=$this->getRequest()->getParam('note');//数据表说明
    	//字段信息
    	$fieldname=$this->getRequest()->getParam("t1","");//字段名称
    	$fieldtype=$this->getRequest()->getParam("t2","");//字段类型
    	$length=$this->getRequest()->getParam("t3","");//字段长度
    	$fieldsign=$this->getRequest()->getParam("t4","");//字段是否标识
    	$fieldmain=$this->getRequest()->getParam("t5","");//字段是否主键
    	$fieldnull=$this->getRequest()->getParam("t6","");//字段是否允许为空
    	$fieldnote=$this->getRequest()->getParam("t7","");//字段说明
   		$username=$_SESSION['login']['Medi_UserName'];//修改人
   		$datetime=date("Y-m-d H:i:s");//修改时间
   		$tableModel=new Meditable();
    	if($tableid=="")//添加数据表
    	{
    		$data=array(
    			'Medi_TableName'=>$name,
    			'Medi_DatabaseID'=>$dataid,
    			'Medi_TableCreatName'=>$username,
    			'Medi_TableCreatTime'=>$datetime,
    			'Medi_TableUpdateName'=>$username,
    			'Medi_TableUpdateTime'=>$datetime,
    			'Medi_TableNote'=>$note
    		);
    		$tableid=$tableModel->insert($data);
    	}
    	else{
    		$data=array(
    				'Medi_TableName'=>$name,
    				'Medi_TableUpdateName'=>$username,
    				'Medi_TableUpdateTime'=>$datetime,
    				'Medi_TableNote'=>$note
    		);
    		$where='Medi_TableID='.$tableid;
    		$tableModel->update($data, $where);
    	}
    	//添加字段信息
    	$contentModel=new Medicontent();
    	$where='Medi_TableID='.$tableid;
    	$contentModel->delete($where);//清空以前的字段数据
    	if($fieldname!=""){
    		$fieldname=explode(',',$fieldname);
    		$fieldtype=explode(',',$fieldtype);
    		$length=explode(',',$length);
    		$fieldsign=explode(',',$fieldsign);
    		$fieldmain=explode(',',$fieldmain);
    		$fieldnull=explode(',',$fieldnull);
    		$fieldnote=explode(',',$fieldnote);
    		for($i=0;$i<count($fieldname);$i++){
    			$fielddata=array(
    					'Medi_DataName'=>$fieldname[$i],
    					'Medi_DataType'=>$fieldtype[$i],
    					'Medi_DataLength'=>$length[$i],
    					'Medi_IsSign'=>$fieldsign[$i],
    					'Medi_IsPrimary'=>$fieldmain[$i],
    					'Medi_IsEmpty'=>$fieldnull[$i],
    					'Medi_DataNote'=>$fieldnote[$i],
    					'Medi_TableID'=>$tableid
    					);
    			$contentModel->insert($fielddata);
    		}
    	}
   		echo json_encode(0);
   		exit();
    }
}