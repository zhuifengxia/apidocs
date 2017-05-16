<?php
class Mediuniversal extends Zend_Db_Table
{
	protected $_name='medi_universal';
    protected $_primary='Medi_CommonID';//接口返回数据说明
  
    //得到目标接口参数通用返回说明
    public function getuniversalbyid($apid)
    {
    	$mediuniversalModel=new Mediuniversal();
    	$where="Medi_ApiID=".$apid;
    	$universaldata=$mediuniversalModel->fetchAll($where)->toArray();
    	return $universaldata;
    }
}
