<?php

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include "searchuser.inc";
	$obj=new SearchUser();
	$res=$obj->SelAll();
	$cnt=$obj->SelAllCount();
	$result["total"]=$cnt;
	$result["rows"] =$res;
	echo json_encode($result);
?>