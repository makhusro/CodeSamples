<?php
include "searchuser.inc";
$id = intval($_REQUEST['id']);
$username = $_REQUEST['username'];
$email = $_REQUEST['email'];

$obj=new SearchUser();
$res=$obj->updateUser($username,$email,$id);
echo json_encode(array(
	'id' => $id,
	'username' => $username,
	'email' => $email
));
?>