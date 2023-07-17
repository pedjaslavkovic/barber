<?php
Class dbObj{
	/* Database connection start */
	var $servername = "localhost";
	var $username = "id21019371_intedlwb_kristian";
	var $password = "Pedja1234!";
	var $dbname = "id21019371_intedlwb_coiffeur";
	var $conn;
	function getConnstring() {
		$con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		} else {
			$this->conn = $con;
		}
		return $this->conn;
	}
}

?>