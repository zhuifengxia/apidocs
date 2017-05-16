<?php
class Medicontent extends Zend_Db_Table
{
	protected $_name='medi_content';
    protected $_primary='Medi_ContentID';//表id
    
    //根据数据表ID得到该表的字段信息
    public function getfields($id)
    {
    	$contentModel=new Medicontent();
    	$where="Medi_TableID=".$id;
    	$fields=$contentModel->fetchAll($where)->toArray();
    	return $fields;
    }
}
