<?php
	/**
	* 
	*/
	require_once __DIR__ . '/Model.php';
	class Model_App extends Database
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function saveInsightGroup($groupId, $updateTime, $jsonString)
		{
			$stmt = $this->conn->prepare("insert into group_insight (group_id, update_time, json) values(?, ?, ?)");
			$stmt->bind_param("sss", $groupId, $updateTime, $jsonString);
			$stmt->execute();
		}
	}
?>