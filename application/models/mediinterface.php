<?php
class Mediinterface extends Zend_Db_Table
{
	protected $_name='medi_interface';
    protected $_primary='Medi_InterfaceID';//接口文档列表
	
    //目标项目的接口文档列表
    public function getinterfacelst($projectid)
    {
    	$interfaceModel=new Mediinterface();
    	$where="Medi_ProjectID=".$projectid;
    	$interfacelst=$interfaceModel->fetchAll($where)->toArray();
    	return $interfacelst;
    }
}
