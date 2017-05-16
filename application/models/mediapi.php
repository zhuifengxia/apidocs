<?php
class Mediapi extends Zend_Db_Table
{
	protected $_name='medi_api';
    protected $_primary='Medi_ApiID';//接口表
    
    //根据接口文档ID得到该文档中所有接口列表
    public function getapilst($interfaceid,$sel)
    {
    	$apiModel=new Mediapi();
    	$where="Medi_InterfaceID=".$interfaceid;
    	if($sel!='0'&&$sel!=''){
    		$where.=" AND Medi_ApiBelongs='".$sel."'";
    	}
    	$apilst=$apiModel->fetchAll($where)->toArray();
    	return $apilst;
    }
    //根据接口ID得到某个接口的详细信息
    public function getapidetail($apid)
    {
    	$apiModel=new Mediapi();
    	$where="Medi_ApiID=".$apid;
    	$apidetail=$apiModel->fetchAll($where)->toArray();
    	return $apidetail[0];
    }
}
