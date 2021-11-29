<?php
class Penilaian
{
	private $conn;
	private $table_name = "penilaian";


	public function __construct($db)
	{
		$this->conn = $db;
	}

	function ambilID()
	{
		$result = "";
		return $result;
	}
	function tampilkd_pakan()
	{
		$query = "SELECT DISTINCT kd_pakan FROM penilaian ORDER BY id";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}
}
