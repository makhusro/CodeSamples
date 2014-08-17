<?php 
	include "searchuser.inc";
	
	$obj=new SearchUser();
	$res=$obj->SelAll();
	$cnt=$obj->SelAllCount();
?> 

<table class="TFtable" >
<tr>
<th>Name</th><th>Email</th>
</tr>


<?php foreach ($res as $row){
echo "<tr><td>".$row['username']. " </td><td>". $row['email']."</td></tr>";
}

?>
<tr>
	<td colspan="2"><p>Total records available <?php date_default_timezone_set("America/New_York"); echo $cnt." <br>"."Time of Last Fetch : " . date("h:i:sa");?></p></td>
</tr>
</table>
