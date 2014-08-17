<?php

$id = intval($_REQUEST['id']);
include "searchuser.inc";
$obj=new SearchUser();
$resid=$obj->delID($id);
print_r($resid);

?>