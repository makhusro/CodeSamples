<?php 
class connection
{
	public function dbconnect()
		{
			return new PDO("mysql:host=localhost;dbname=test","XXXXXX","XXXXXX");

		}
}

?>