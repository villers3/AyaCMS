<?php
defined('IN_AYA') or exit('Access Denied');

$in_sub=isset($_GET['in_sub']);

if($in_sub)
	$items=$CS[$itemid];
else
	$items=$CS[0];

empty($items)&&amsg(l('其下没有可排序的项目'),'i');

if(IN_POST){
	extract($posts);
	is_array($ids) or amsg(l('参数错误'),'w');
	empty($ids)&&amsg(l('参数错误'),'w');
	
	foreach($ids as $k=>$id){
		$id=(int)$id;
		$order=count($ids)-(int)$k;
		
		$db->query("UPDATE {$db->pre}class SET listorder={$order} WHERE itemid={$id}");
	}
	
	amsg(l('更新成功'),'s',AYA_ADMIN_URL.'?action=class&channelid='.$channelid.'&in_module=1');
}

include template($action,'article');