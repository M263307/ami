<?php
		include('database_connection.php');
		
		$sql = "SELECT * FROM treeview ";
	$res = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
	
		//iterate on results row and create new index array of data
		while( $row = mysqli_fetch_assoc($res) ) { 
			$tmp = array();
			$tmp['id'] = $row['id'];
			$tmp['name'] = $row['name'];
			$tmp['text'] = $row['name'];
			$tmp['parent_id'] = $row['parent_id'];
			$data[]= $tmp; 
		}
		//$itemsByReference = array();

	// Build array of item references:
	foreach($data as $key => &$item) {
	   $itemsByReference[$item["id"]] = &$item;
	   // Children array:
	   //$itemsByReference[$item['id']]['nodes'] = array();
	}

	// Set items as children of the relevant parent item.
	foreach($data as $key => &$item)  {
	//echo "<pre>";print_r($data);echo "<pre>";die;
	   if($item["parent_id"] && isset($itemsByReference[$item["parent_id"]])) {
	      $itemsByReference [$item["parent_id"]]["nodes"][] = &$item;
		}
	}
	foreach($data as $key => &$item) {
		if($item["parent_id"] && isset($itemsByReference[$item["parent_id"]])) {
			unset($data[$key]);
		}
	}
	
	echo json_encode($data);
//	echo '<pre>';
//	print_r($data);
//	echo '<pre>';

?>