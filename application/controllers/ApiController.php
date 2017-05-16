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
require_once APPLICATION_PATH.'/models/mediinterface.php';//接口文档列表
require_once APPLICATION_PATH.'/models/mediapi.php';//接口表
require_once APPLICATION_PATH.'/models/medirequestparameter.php';//接口参数表
require_once APPLICATION_PATH.'/models/mediuniversal.php';//接口返回通用参数表
class ApiController extends BaseController
{
/*
创建时间：2014.5.19  下午
创建人：刘单风
内容主题：接口
*/
	
	//目标项目的接口文档列表页面
    public function interfacelstAction()
    {
    	$interfaceModel=new Mediinterface();
    	$projectid=$this->getRequest()->getParam('projectid');//项目ID
    	$projectname=$this->getRequest()->getParam('projectname');//项目项目名称
    	$interfacelst=$interfaceModel->getinterfacelst($projectid);//获取目标项目的接口文档列表
    	if(count($interfacelst)<=0)
    	{
    		$this->view->result="暂无数据！";
    	}
    	$this->view->interfacelst=$interfacelst;//目标项目接口文档列表返回页面
    	$this->view->projectname=$projectname;//项目名称返回页面
    	$this->view->projectid=$projectid;//项目id返回页面
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    }
    //查看某个接口文档的接口列表
    public function apilstAction()
    {
    	$apiModel=new Mediapi();
    	$db=$apiModel->getAdapter();
    	$interfaceid=$this->getRequest()->getParam('interfaceid');//接口文档ID
    	$projectid=$this->getRequest()->getParam('projectid');//项目ID
    	$sel=$this->getRequest()->getParam('sel');//模块名称
		if($_SESSION['login']['Medi_UserName']=="linshi")
		{
			$sel="指南模块接口";
		}
    	$apilst=$apiModel->getapilst($interfaceid,$sel);
    	if(count($apilst)<=0)
    	{
    		$this->view->result="暂无接口数据！";
    	}
    	$sql="SELECT DISTINCT Medi_ApiBelongs from medi_api";
    	$model=$db->query($sql)->fetchAll();
    	$this->view->model=$model;
    	$this->view->apilst=$apilst;
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    	$this->view->projectid=$projectid;//项目ID
    	$this->view->interfaceid=$interfaceid;//接口文档ID
    	$this->view->sel=$sel;//模块名称
    }
    
    //接口查看页面
    public function apilookAction()
    {
    	$apiid=$this->getRequest()->getParam("apiid");//接口ID
    	$interfaceid=$this->getRequest()->getParam("interfaceid");//接口文档ID
   		$projectid=$this->getRequest()->getParam('projectid');//项目ID
   		$mediapiModel=new Mediapi();
   		$apidetail=$mediapiModel->getapidetail($apiid);//得到接口的详细信息
   		//同时获取接口请求参数以及返回参数参数说明，以及返回通用数据说明
   		$parameterModel=new Medirequestparameter();
   		$parameterdata=$parameterModel->getparameterbyid($apiid,0);//得到该接口的请求参数
   		$parameterdata2=$parameterModel->getparameterbyid($apiid,1);//得到该接口的返回参数说明
   		$universalModel=new Mediuniversal();
   		$universaldata=$universalModel->getuniversalbyid($apiid);//返回通用数据说明
   		$this->view->apidetail=$apidetail;
		$this->view->parameterdata=$parameterdata;
  		$this->view->parameterdata2=$parameterdata2;
   		$this->view->universaldata=$universaldata;
   		$this->view->interfaceid=$interfaceid;
		$this->view->projectid=$projectid;//项目ID
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    }
    
    //接口编辑/添加页面
    public function apieditAction()
    {
    	$edittype=$this->getRequest()->getParam("edittype");//操作类型，0是添加，1编辑
    	$apiid=$this->getRequest()->getParam("apiid");//接口ID
    	$interfaceid=$this->getRequest()->getParam("interfaceid");//接口文档ID
   		$projectid=$this->getRequest()->getParam('projectid');//项目ID
    	if($edittype==1)//说明是接口编辑
    	{
    		$mediapiModel=new Mediapi();
    		$apidetail=$mediapiModel->getapidetail($apiid);//得到接口的详细信息
    		//同时获取接口请求参数以及返回参数参数说明，以及返回通用数据说明
    		$parameterModel=new Medirequestparameter();
    		$parameterdata=$parameterModel->getparameterbyid($apiid,0);//得到该接口的请求参数
    		$parameterdata2=$parameterModel->getparameterbyid($apiid,1);//得到该接口的返回参数说明
    		$universalModel=new Mediuniversal();
    		$universaldata=$universalModel->getuniversalbyid($apiid);//返回通用数据说明
   			$this->view->apidetail=$apidetail;
    		$this->view->parameterdata=$parameterdata;
    		$this->view->parameterdata2=$parameterdata2;
    		$this->view->universaldata=$universaldata;
    	}
    	$this->view->edittype=$edittype;
    	$this->view->loginuser=$_SESSION['login'];//用户信息返回页面
    	$this->view->interfaceid=$interfaceid;
		$this->view->projectid=$projectid;//项目ID
    }
    
    //接口编辑/添加保存
    public function apieditsaveAction()
    {
    	$edittype=$this->getRequest()->getParam("edittype");//操作类型，0是添加，1编辑
    	$interfaceid=$this->getRequest()->getParam("interfaceid");//接口文档ID
   		$projectid=$this->getRequest()->getParam('projectid');//项目ID
    	$mediapiModel=new Mediapi();
    	$parameterModel=new Medirequestparameter();
    	$universalModel=new Mediuniversal();
    	$apiname=$this->getRequest()->getParam("apiname");//接口名称
   		$apibelong=$this->getRequest()->getParam("apibelong");//接口所属模块
   		$apiaction=$this->getRequest()->getParam("apiaction");//接口作用
   		$apiurl=$this->getRequest()->getParam("apiurl");//接口地址
   		$apitesturl=$this->getRequest()->getParam("apitesturl");//接口测试地址
   		$apiformat=$this->getRequest()->getParam("apiformat");//接口支持格式
   		$apirequest=$this->getRequest()->getParam("apirequest");//接口请求方式
   		$apiresult=$this->getRequest()->getParam("apiresult");//接口返回结果
   		$apiid=$this->getRequest()->getParam("apiid");//接口ID
   		$username=$_SESSION['login']['Medi_UserName'];//修改人
   		$datetime=date("Y-m-d H:i:s");//修改时间
    	if($edittype==0)//添加接口
    	{
    		$adddata=array(
    			'Medi_ApiName'=>$apiname,
    			'Medi_ApiBelongs'=>$apibelong,
    			'Medi_ApiUpdateTime'=>$datetime,
    			'Medi_ApiUpdateName'=>$username,
    			'Medi_ApiAction'=>$apiaction,
    			'Medi_ApiUrl'=>$apiurl,
    			'Medi_ApiFormat'=>$apiformat,
    			'Medi_ApiRequest'=>$apirequest,
    			'Medi_ApiResult'=>$apiresult,
    			'Medi_ApiCreateTime'=>$datetime,
    			'Medi_ApiCreateName'=>$username,
    			'Medi_InterfaceID'=>$interfaceid,
    			'Medi_ApiTestUrl'=>$apitesturl
    		);
    		$apiid=$mediapiModel->insert($adddata);
    	}
    	else //编辑接口
    	{
    		//保存接口详细信息
    		$editdata=array(
    			'Medi_ApiName'=>$apiname,
    			'Medi_ApiBelongs'=>$apibelong,
    			'Medi_ApiUpdateTime'=>$datetime,
    			'Medi_ApiUpdateName'=>$username,
    			'Medi_ApiAction'=>$apiaction,
    			'Medi_ApiUrl'=>$apiurl,
    			'Medi_ApiFormat'=>$apiformat,
    			'Medi_ApiRequest'=>$apirequest,
    			'Medi_ApiResult'=>$apiresult,
    			'Medi_ApiTestUrl'=>$apitesturl
    		);
    		$editwhere="Medi_ApiID=".$apiid;
    		$mediapiModel->update($editdata,$editwhere);
    	}
    	//保存接口请求参数数据
   		$par1name=$this->getRequest()->getParam("par1name");//接口请求参数中参数名
   		$par1type=$this->getRequest()->getParam("par1type");//接口请求参数中参数类型
   		$par1info=$this->getRequest()->getParam("par1info");//接口请求参数中参数说明
   		//清空之前数据
   		$qusesql="Medi_ApiID=".$apiid." AND Medi_ParameterType=0";
   		$parameterModel->delete($qusesql);
   		for($i=0;$i<count($par1name);$i++)
   		{
   			$par1data=array(
   				'Medi_RequestName'=>$par1name[$i],
   				'Medi_RequestType'=>$par1type[$i],
   				'Medi_RequestInfo'=>$par1info[$i],
   				'Medi_ParameterType'=>0,
   				'Medi_ApiID'=>$apiid
   			);
   			$parameterModel->insert($par1data);
   		}
   		
   		//保存接口通用返回数据
   		$unname=$this->getRequest()->getParam("unname");//接口通用返回数据说明中参数名
   		$untypep=$this->getRequest()->getParam("untypep");//接口通用返回数据说明中参数类型
   		$unvalue=$this->getRequest()->getParam("unvalue");//接口通用返回数据说明中value值
   		$uninfo=$this->getRequest()->getParam("uninfo");//接口通用返回数据说明中参数说明
   		//清空之前数据
   		$unql="Medi_ApiID=".$apiid;
   		$universalModel->delete($unql);
   		for($a=0;$a<count($unname);$a++)
   		{
   			$undata=array(
   				'Medi_CommonName'=>$unname[$a],
   				'Medi_CommonType'=>$untypep[$a],
   				'Medi_CommonValue'=>$unvalue[$a],
   				'Medi_CommonInfo'=>$uninfo[$a],
   				'Medi_ApiID'=>$apiid
   			);
   			$universalModel->insert($undata);
   		}
   		
   		//保存返回具体参数数据
   		$par2name=$this->getRequest()->getParam("par2name");//接口返回具体参数中参数名
   		$par2type=$this->getRequest()->getParam("par2type");//接口返回具体参数中参数类型
   		$par2info=$this->getRequest()->getParam("par2info");//接口返回具体参数中参数说明
    	//清空之前数据
   		$qsesql="Medi_ApiID=".$apiid." AND Medi_ParameterType=1";
   		$parameterModel->delete($qsesql);
   		for($i=0;$i<count($par2name);$i++)
   		{
   			$par2data=array(
   				'Medi_RequestName'=>$par2name[$i],
   				'Medi_RequestType'=>$par2type[$i],
   				'Medi_RequestInfo'=>$par2info[$i],
   				'Medi_ParameterType'=>1,
   				'Medi_ApiID'=>$apiid
   			);
   			$parameterModel->insert($par2data);
   		}
   		echo "<script>alert('保存成功！');window.location.href='/Api/apilst?interfaceid=".$interfaceid."&projectid=".$projectid."';</script>";
   		exit();
    }
    
    //测试接口
    public function apitesturlAction()
    {
    	$testurl=$this->getRequest()->getParam("testurl");//测试地址链接
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $testurl);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	
    	$response = curl_exec($ch);
    	curl_close($ch);		
		$this->view->jsoncode=$response;
    }
    
    //接口删除
    public function apidelAction()
    {
    	$apiid=$this->getRequest()->getParam("id");//接口ID
    	$mediapiModel=new Mediapi();
    	$db=$mediapiModel->getAdapter();
    	$where="Medi_ApiID=".$apiid;
    	$mediapiModel->delete($where);
    	//同时删除接口请求参数以及返回参数
    	$sql1="DELETE FROM medi_requestparameter WHERE Medi_ApiID=".$apiid;
    	$db->query($sql1);
    	//同时删除接口返回通用数据
    	$sql2="DELETE FROM medi_universal WHERE Medi_ApiID=".$apiid;
    	$db->query($sql2);
    	echo json_encode(0);
    	exit();
    }
}