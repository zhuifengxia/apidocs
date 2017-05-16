<?php
class Medirequestparameter extends Zend_Db_Table
{
	protected $_name='medi_requestparameter';
    protected $_primary='Medi_RequestID';//表id
    
    //根据接口ID得到该接口的参数信息等数据
    public function getparameterbyid($apid,$type)
    {
    	$parameterModel=new Medirequestparameter();
    	$where="Medi_ApiID=".$apid." AND Medi_ParameterType=".$type;
    	$parameterdata=$parameterModel->fetchAll($where)->toArray();
    	return $parameterdata;
    }
}
