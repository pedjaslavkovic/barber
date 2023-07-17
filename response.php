
<?php
    
    file_put_contents('./response.log', print_r([
			'referrer' => $_SERVER['HTTP_REFERER'],
			'request' => $_REQUEST,
		], true), FILE_APPEND);

	//include connection file 
	include_once("connection.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	if (isset($_REQUEST['form_id'])) {
		$params = [
			'action' => 'add',
            'name' => $_REQUEST['Vor-_und_Nachname'],
            'email' => $_REQUEST['E-Mail'],
            'geburtstag' => $_REQUEST['Geburtstag'],
            'nummer' => $_REQUEST['Telefonnummer'],
            'adresse' => $_REQUEST['Strasse,_Postleitzahl_und_Ort'],
            'termindatum' => $_REQUEST['Wunschtermin_Datum'],
            'terminzeit' => $_REQUEST['Wunschtermin_Zeit'],
            'service1' => $_REQUEST['Service_1'],
            'service2' => $_REQUEST['Service_2'],
            'service3' => $_REQUEST['Service_3'],
            'useri' => 'Cristian'
		];
	}
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new Employee($connString);

	switch($action) {
	 case 'add':
		$empCls->insertEmployee($params);

	 break;
	 case 'edit':
		$empCls->updateEmployee($params);
	 break;
	 case 'delete':
		$empCls->deleteEmployee($params);
	 break;
	 case 'approve':
        $empCls->approveEmployee($params);
    break;
    case 'remove':
        $empCls->removeEmployee($params);
    break;
	 default:
	 $empCls->getEmployees($params);
	 return;
	}
	
	class Employee {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getEmployees($params) {
		
		$this->data = $this->getRecords($params);
		
		echo json_encode($this->data);
	}
	function insertEmployee($params) {
    $response = array();
    $sql = "INSERT INTO `employee` (name, email, geburtstag, nummer, adresse, termindatum, terminzeit, service1, service2, service3, useri, approved) VALUES('" . $params["name"] . "', '" . $params["email"] . "','" . $params["geburtstag"] . "','" . $params["nummer"] . "','" . $params["adresse"] . "','" . $params["termindatum"] . "','" . $params["terminzeit"] . "','" . $params["service1"] . "','" . $params["service2"] . "','" . $params["service3"] . "','" . $params["useri"] . "', 0);  ";

    $result = mysqli_query($this->conn, $sql);
    
    if ($result) {
        $response['status'] = 'success';
        $response['message'] = 'Employee inserted successfully';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to insert employee: ' . mysqli_error($this->conn);
    }
    
    echo json_encode($response);
}
	
	
	function getRecords($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( name LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR termindatum LIKE '".$params['searchPhrase']."%' ";

			$where .=" OR service1 LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "SELECT * FROM `employee` ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot employees data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch employees data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	function updateEmployee($params) {
		$data = array();
    //print_R($_POST);die;
    $sql = "Update `employee` set name = '" . $params["edit_name"] . "', email='" . $params["edit_email"]."', geburtstag='" . $params["edit_geburtstag"] . "', nummer='" . $params["edit_nummer"] . "', adresse='" . $params["edit_adresse"] . "', termindatum='" . $params["edit_termindatum"] . "', terminzeit='" . $params["edit_terminzeit"] . "', service1='" . $params["edit_service1"] . "', service2='" . $params["edit_service2"] . "', service3='" . $params["edit_service3"] . "', useri='" . $params["edit_useri"] . "', approved='".$params["edit_approved"]."' WHERE id='".$_POST["edit_id"]."'";
    
		echo $result = mysqli_query($this->conn, $sql) or die("error to update employee data");
	}
	
	function approveEmployee($params) {
    $data = array();
    $sql = "UPDATE `employee` SET approved=1 WHERE id='".$params["id"]."'";
    
    echo $result = mysqli_query($this->conn, $sql) or die("error to approve employee data");
}

function removeEmployee($params) {
    $data = array();
    $sql = "UPDATE `employee` SET approved=0 WHERE id='".$params["id"]."'";
    
    echo $result = mysqli_query($this->conn, $sql) or die("error to approve employee data");
}
	
	function deleteEmployee($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "delete from `employee` WHERE id='".$params["id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to delete employee data");
	}
}
?>
	