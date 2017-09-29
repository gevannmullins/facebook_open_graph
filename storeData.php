<?php

class User {
	public $table_name = 'fb_users';
	
	function __construct(){
		/* database configuration */
		$dbServer = 'localhost';
		$dbUsername = 'admin';
		$dbPassword = 'admin';
		$dbName = 'facebook_ninja';
		
		/* connect database */
		$con = mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
		if(mysqli_connect_errno()){
			die("Failed to connect with MySQL: ".mysqli_connect_error());
		}else{
			$this->connection = $con;
		}
	}
	
	function checkFBUserData($user){
		$prev_query = mysqli_query($this->connection,"SELECT * FROM ".$this->table_name." WHERE facebook_id = '".$user['id']."'") or die(mysqli_error($this->connection));
		if(mysqli_num_rows($prev_query)>0){
			$update = mysqli_query($this->connection,"UPDATE $this->table_name SET facebook_id = '".$user['id']."', first_name = '".$user['first_name']."', last_name = '".$user['last_name']."', email = '".$user['email']."', gender = '".$user['gender']."', picture = '".$user['picture']['data']['url']."' WHERE facebook_id = '".$user['id']."'");
		}else{
			$insert = mysqli_query($this->connection,"INSERT INTO $this->table_name SET facebook_id = '".$user['id']."', first_name = '".$user['first_name']."', last_name = '".$user['last_name']."', email = '".$user['email']."', gender = '".$user['gender']."', picture = '".$user['picture']['data']['url']."'");
		}
		
		$query = mysqli_query($this->connection,"SELECT * FROM $this->table_name WHERE facebook_id = '".$user['id']."'");
		$result = mysqli_fetch_array($query);
		return $result;
	}
}
?>