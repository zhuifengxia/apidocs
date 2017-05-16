<?php
class Meditable extends Zend_Db_Table
{
	protected $_name='medi_table';
    protected $_primary='Medi_TableID';//数据表id
    
    //根据数据库字典ID得到该文档中数据表总数
    public function tablecount($id)
    {
    	$tableModel=new Meditable();
    	$where="Medi_DatabaseID=".$id;
    	$res=$tableModel->fetchAll($where)->toArray();
    	return count($res);
    }
    
    //根据数据库字典ID列出该文档中数据表
    public function gettable($id,$start,$num)
    {
    	$tableModel=new Meditable();
    	$db=$tableModel->getAdapter();
    	$sql="SELECT * FROM medi_table WHERE Medi_DatabaseID=$id LIMIT $start,$num";
    	$result=$db->query($sql)->fetchAll();
    	return $result;
    }
    //根据表ID得到表的详细信息
    public function getdetail($id)
    {
    	$tableModel=new Meditable();
    	$db=$tableModel->getAdapter();
    	$sql="SELECT * FROM medi_table WHERE Medi_TableID=$id";
    	$detail=$db->query($sql)->fetchAll();
    	return $detail[0];
    }
}
