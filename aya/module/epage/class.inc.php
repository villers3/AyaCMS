<?php
defined('IN_AYA') or exit('Access Denied');
class epage{
	var $db;
	var $channel;
	var $channelid;
	var $table;
	var $posts;
	var $fds;
	var $htmlid;
	var $msg;
	function epage(){
		global $db;
		$this->db=&$db;
	}
	function check(&$p){
		return true;
	}
	function fields_check(&$p){
		$fd=cache_read('field-'.$this->table.'.php');
		fields_check($p,$fd);
		return true;
	}
	function add($p){
		return true;
	}
	function edit(&$p){
		$sql=sql_update($p);
		$this->db->query("UPDATE ".PF.$this->table." SET ".$sql." WHERE itemid='".$p['itemid']."'");
		return true;
	}
	function del($itemid){	
		return true;		
	}
	function channel_clean($item){
		$fd=cache_read('field-epage.php');
		fields_data_del($fd,$item);
		$db->query("delete from {$db->pre}epage where itemid='".$item['itemid']."'");
		return true;
	}
	function get_one($field,$val){
		$where='`'.$field.'`="'.addslashes($val).'"';
		return $this->db->get_one("SELECT * FROM ".PF.$this->table."  WHERE ".$where);
	}
}
?>