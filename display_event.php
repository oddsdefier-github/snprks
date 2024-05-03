<?php
require 'connect.php';

// Query to select event data from the database
$display_query = "SELECT * FROM schedules";
$results = mysqli_query($conn, $display_query);


$count = mysqli_num_rows($results);

if ($count > 0) {
	// If there are rows returned, initialize an empty array to store the event data
	$data_arr = array();
	$i = 1;

	// Loop through each row of the result set
	while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
		// Store the event data in the array
		$data_arr[$i]['id'] = $data_row['id'];
		$data_arr[$i]['event_name'] = $data_row['event_name'];
		$data_arr[$i]['priest'] = $data_row['priest'];
		$data_arr[$i]['client_name'] = $data_row['client_name'];
		$data_arr[$i]['address'] = $data_row['address'];
		$data_arr[$i]['date'] = $data_row['date'];
		$data_arr[$i]['time'] = $data_row['time'];
		$i++;
	}

	// Create a response array with the status, message, and event data
	$data = array(
		'status' => true,
		'msg' => 'successfully!',
		'data' => $data_arr
	);
} else {
	// If no rows are returned, create a response array with the status and error message
	$data = array(
		'status' => false,
		'msg' => 'Error!'
	);
}


echo json_encode($data);
?>