<?php 
class connection
{
	public function dbconnect()
		{
			return new PDO("mysql:host=localhost;dbname=test","root","Winter67@");

		}
}

?>