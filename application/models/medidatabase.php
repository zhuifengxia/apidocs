<?php
class Medidata extends Zend_Db_Table
{
	protected $_name='medi_database';
    protected $_primary='Medi_DataID';//数据库文档列表id
	
    //目标项目的数据库文档列表
    public function getdatalst($projectid)
    {
    	$dataModel=new Medidata();
    	$where="Medi_ProjectID=".$projectid;
    	$datalst=$dataModel->fetchAll($where)->toArray();
    	return $datalst;
    }
}
