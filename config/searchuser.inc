<?php

include ('config/connection.inc');
class SearchUser
{
	private $db;
	public function __construct()
		{
			$this->db=new connection();
			$this->db=$this->db->dbconnect();
		}
	
	public function SelAll()
	{
			
			$st = $this->db->prepare("select * from users");
			$st->execute();
			$rows=$st->fetchAll(PDO::FETCH_ASSOC);
		    return $rows;

	}
	public function verify($username,$email)
	{
		if((!empty($username)) && (!empty($email)))
			{
				$st=$this->db->prepare("select * from users where username=? and email=?");
				$st->bindParam(1,$username);
				$st->bindParam(2,$email);
				$st->execute();
				if ($st->rowCount()==1){
					$rows=$st->fetch(PDO::FETCH_ASSOC);
					return $rows;
					echo "user and email exists";}
				else{echo "incorrect user and email ";}

		
			}
		else
			{echo "username and email are empty";}
	}



	public function searchID($id)
	{
		if(!empty($id))
			{
				$st=$this->db->prepare("select * from users where id=? ");
				$st->bindParam(1,$id);
				$st->execute();
				if ($st->rowCount()==1)
					{
						$rows=$st->fetch(PDO::FETCH_OBJ);
						return $rows;
						
					}
				

		
			}
		
	}

	
}


?>