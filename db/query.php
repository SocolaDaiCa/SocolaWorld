<?php 
	/**
	* class DB
	*/
	class DB
	{
		private $conn;
		function __construct()
		{
			$this->conn = new MySQLi(hostName, username, password, databaseName);
			if ($this->conn->connect_errno) {
				die("ERROR : -> ".$this->conn->connect_error);
			}
			mysqli_set_charset($this->conn,"utf8");
		}
		function __destruct(){
			$this->conn->close();
		}
		/* check */
		public function isUserExist($userId)
		{
			$sql = "SELECT count(user_id) AS `count` FROM `user` WHERE `user_id`='{$userId}'";
			return $this->conn->query($sql)->fetch_assoc()['count'] == 1;
		}
		public function isInBlackList($userId)
		{
			return false;
		}
		/*  */
		public function addUser($userId, $userName, $token, $email = '', $password = '')
		{
			if($this->isUserExist($userId)){ // cập nhật token
				$sql = "UPDATE `user` SET `user_name`='{$userName}', `access_token`='{$token}', `email`='{$email}', `password`='{$password}' WHERE `user_id`='{$userId}'";
			} else { // thêm mới
				$sql = "INSERT INTO `user` VALUES ('{$userId}', '{$userName}', '{$token}', '{$email}', '{$password}')";
			}
			$this->conn->query($sql);
		}
		public function getInsightGroup($idGroup)
		{
			$sql = "SELECT  `update_time`,`json` FROM `group_insight` WHERE `group_id`='{$idGroup}' ORDER BY `update_time` DESC LIMIT 0,1";
			$data = $this->conn->query($sql)->fetch_assoc();
			$data['json'] = json_decode($data['json']);
			return $data;
		}
		public function saveInsightGroup($groupId, $updateTime, $jsonString)
		{
			$sql = "INSERT INTO group_insight (group_id, update_time, json) VALUES ('{$groupId}', '{$updateTime}', '{$jsonString}')";
			$this->conn->query($sql);
		}
		public function checkRemindHashTag($postId)
		{
			$sql = "SELECT count(post_id) as `count` FROM `remind_hashtag` where `post_id`='{$postId}'";
			return $this->conn->query($sql)->fetch_assoc()['count'] > 0;
		}
		public function saveRemindHashTag($postId)
		{
			$sql = "INSERT INTO remind_hashtag (post_id) VALUES ('{$postId}')";
			$this->conn->query($sql);
		}
		/* post dont care*/
		public function getListPostsDontCare($userId)
		{
			/* xem có để get hay k nếu không có thì trả về mảng rỗng*/
			$sql = "SELECT count(json) as `count` FROM `post_dont_care` where `user_id`='{$userId}'";
			if(!$this->conn->query($sql)->fetch_assoc()['count']){
				return '[]';
			}
			/*nếu có thì trả về*/
			$sql = "SELECT `json` FROM `post_dont_care` where `user_id`='{$userId}'";
			return $this->conn->query($sql)->fetch_assoc()['json'];
		}

	}
?>