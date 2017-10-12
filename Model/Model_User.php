<?php 
	/**
	* 
	*/
	require_once __DIR__ . '/Database.php';
	class Model_User extends Database
	{
		function __construct()
		{
			parent::__construct();
		}
		public function issetUser($userID)
		{
			$sql = "select count(user_id) from user where user_id = '$userID'";
			return $this->query($sql)[0][0] != 0;
		}
		public function createUser($userID, $username, $token, $email = '', $password = '')
		{
			$sql = "INSERT INTO user (user_id, user_name, access_token, email, password) VALUES ('$userID', '$username', '$token', '$email', '$password')";
			echo($sql);
			$this->run($sql);
		}
		public function updateUser($userID, $username, $token, $email = '', $password = '')
		{
			$sql = "update user set user_name='$username', access_token='$token', email='$email', password='$password' where user_id = '$userID'";
			$this->run($sql);
		}
		public function addUser($userID, $username, $token, $email = '', $password = '')
		{
			if($this->issetUser($userID)){
				return $this->updateUser($userID, $username, $token, $email, $password);
			}
			$this->createUser($userID, $username, $token, $email = '', $password = '');
		}
		public function getInfo()
		{
			[
				'userid' => $id,
				'username' => $name
			] = $_COOKIE;
			return array(
				'id' => $id,
				'name' => $name,
				'avartar' => "https://graph.facebook.com/{$id}/picture?type=large&redirect=true&width=40&height=40"
			);
		}
	}
?>