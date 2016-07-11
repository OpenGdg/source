<?php

$app->post('/newevent',function() use($app) {
	$response = array();
	$r = json_decode($app->request->getBody());
	$db = new DbHandler();
	$name = $r->newevent->name;
	$description = $r->newevent->description;
	$contact_phone = $r->newevent->contact_phone;
	$contact_mail = $r->newevent->contact_mail;
	$venue = $r->newevent->venue;
	$city = $r->newevent->city;
	$created_by = $r->newevent->created_by;
	$table_name = "event";
	$json_string='{"username":"'.$name.'"}';
    $rootfile=fopen("json/".$name.".json",'w');
    fwrite($rootfile, json_encode($json_string));
            
	/**
	$column_names = array('name', 'description', 'contact_phone', 'contact_mail', 'venue', 'city', 'created_by');
	$result = $db->insertIntoTable($r->event, $column_names, $table_name); 
	if($result != NULL) {
		$response["status"] = "success";
		$response["message"]= "event created successfully";
	} else {
		$response["status"] = "error";
		$response["message"] = "Failed to create event. Please try again";
		echoResponse(201, $response);
	}
	**/
});

?>
