<?php 
include('config/searchuser.inc');
$obj=new SearchUser();
$res=$obj->SelAll();
foreach ($res as $row)
{
    echo $row['id']." | ".$row['username']." | ".$row['email']."<br>";
}
echo "<br>";
?>
<form  action="test.php" method="POST">
  <select name="id" onchange="this.form.submit()">
	  <option value="">select a value</option>
    <?php foreach ($res as $row) { ?>
      <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
    <?php } ?>
  </select>
  </form>
<?php 
if (isset($_POST)!="")
{
	$id =$_POST['id'];
	$resid=$obj->searchID($id);
	echo $resid->id." | ". $resid->username." | ".$resid->email; 
} 
?>				
	  
	  	  





               
          