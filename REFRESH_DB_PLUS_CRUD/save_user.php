<?php
include "searchuser.inc";
$username = $_REQUEST['username'];
$email = $_REQUEST['email'];
$obj=new SearchUser();
$res=$obj->insertUser($username,$email);
echo json_encode(array(
	'id' => $res,
	'username' => $username,
	'email' => $email
));

?>