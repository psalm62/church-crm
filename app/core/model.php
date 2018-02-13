<?php

/**
 * summary
 */
class Model
{
	function __construct($dbh)
	{
		try 
		{
			$this->dbh = $dbh;	
		} 
		catch (Exception $e) 
		{
			exit('Не получилось соедениться с базой');
		}
	}
	public function testLogin($login, $pass)
	{
		$sql = 'SELECT * FROM `users` WHERE `login`=:login';
		$stmt = $this->dbh->prepare($sql);
    	$stmt->bindValue(':login', $login);
    	$stmt->execute();

    	if(($row=$stmt->fetch()) && password_verify($pass, $row['pass']))
    	{
    		return $row;
    	}
    	else
    	{
    		return false;
    	}
	}
	public function getAllSum($id)
	{
		$sql = 'SELECT * FROM `donate_home` WHERE `homeid`=:id';
		$stmt = $this->dbh->prepare($sql);
    	$stmt->bindValue(':id', $id);
    	$stmt->execute();
    	$data=array();
    	while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    	{
    		$data[]=$row;     
    	}
    	return $data;
	}
	public function deletePaid($id)
	{
		$sql = 'DELETE FROM `donate_home` WHERE `id`=:id';
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}
}