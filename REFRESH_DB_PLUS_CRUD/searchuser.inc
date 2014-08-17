<?php

include ('connection.inc');
class SearchUser
{
	private $db;
	public function __construct()
		{
			$this->db=new connection();
			$this->db=$this->db->dbconnect();
		}
	
	public function SelAllCount()
	{
			
			$st = $this->db->prepare("select * from users");
			$st->execute();
			$cnt=$st->rowCount();
			return $cnt;

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
	public function searchName($searchVal)
	{
		if(!empty($searchVal))
			{
				$st=$this->db->prepare("SELECT username,email FROM users WHERE username LIKE ? order by username desc limit 0,10");
				$st->bindValue(1, "$searchVal%", PDO::PARAM_STR);
				$st->execute();
				$rows=$st->fetch(PDO::FETCH_ASSOC);
				$data = array();
				if (!$st->rowCount() == 0) 
				{
					while ($results = $st->fetch()) 
					{
						echo $results['username']." ".$results['email']. "<br />\n";
						$data[] = array(
						'label' => $results['username'] .', '. $results['email'] ,
						'value' => $results['username']
							);
					}

				} 
				else 
				{
					echo 'Nothing found';
				}
				return $data;
			}

				
				
					
	}

	

	public function insertUser($username,$email)
	{
		if((!empty($username)) && (!empty($email)))
			{
				$st=$this->db->prepare("insert into users(username,email) values(?,?) ");
				$st->bindParam(1,$username); 
				$st->bindParam(2,$email);
				$res=$st->execute();
				$lid= $this->db->lastInsertId(); 
				 
				if ($res){
				return $lid;
				}
				else{echo "user could not be inserted";}

		
			}
		else
			{echo "username and email are empty";}
	}
	public function updateUser($username,$email,$id)
	{
		if((!empty($username)) && (!empty($email)) &&(!empty($id)) )
			{
				$st=$this->db->prepare("UPDATE users SET username=? ,email=?  WHERE id=? ");
				$st->bindParam(1,$username); 
				$st->bindParam(2,$email);
				$st->bindParam(3,$id);
				$res=$st->execute();
				 
				if ($res){echo "user updated successfully";}
				else{echo "user could not be inserted";}

		
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

	public function delID($id)
	{
		if(!empty($id))
			{
				$st=$this->db->prepare("delete from users where id=? ");
				$st->bindParam(1,$id);
				if($st->execute()){
				echo "user deleted";
				}
				else{
				echo "user could not be deleted";
				};
			}
		
	}

	
}


?>