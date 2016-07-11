<?php 
$app->get('/session', function() {
    $db = new DbHandler();
    $session = $db->getSession();
    $response["uid"] = $session['uid'];
    $response["email"] = $session['email'];
    $response["name"] = $session['name'];
    echoResponse(200, $session);
});

$app->post('/login', function() use ($app) {
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('email', 'password'),$r->customer);
    $response = array();
    $db = new DbHandler();
    $password = $r->customer->password;
    $email = $r->customer->email;
    $user = $db->getOneRecord("select uid,name,password,email,created from customers_auth where phone='$email' or email='$email'");
    if ($user != NULL) {
        if(passwordHash::check_password($user['password'],$password)){
        $response['status'] = "success";
        $response['message'] = 'Logged in successfully.';
        $response['name'] = $user['name'];
        $response['uid'] = $user['uid'];
        $response['email'] = $user['email'];
        $response['createdAt'] = $user['created'];
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $user['name'];
        } else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. Incorrect credentials';
        }
    }else {
            $response['status'] = "error";
            $response['message'] = 'No such user is registered';
        }
    echoResponse(200, $response);
});

$app->post('/signUp', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('email', 'name', 'password'),$r->customer);
    require_once 'passwordHash.php';
    $db = new DbHandler();
    $phone = $r->customer->phone;
    $name = $r->customer->name;
    $email = $r->customer->email;
    $address = $r->customer->address;
    $password = $r->customer->password;
    $isUserExists = $db->getOneRecord("select 1 from customers_auth where phone='$phone' or email='$email'");
    if(!$isUserExists){
        $r->customer->password = passwordHash::hash($password);
        $tabble_name = "customers_auth";
        $column_names = array('phone', 'name', 'email', 'password', 'city', 'address');
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
        if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response["uid"] = $result;
            $json_string='{"username":"'.$name.'","api":"0","password":"'.$password.'","emailid":"'.$email.'","location":"'.$address.'","phoneno":"'.$phone.'","eventslist":[]}';
            $rootfile=fopen("json/".$name.".json",'w');
            fwrite($rootfile, json_encode($json_string));
            
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['uid'] = $response["uid"];
            $_SESSION['phone'] = $phone;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            echoResponse(200, $response);
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create customer. Please try again";
            echoResponse(201, $response);
        }            
    }else{
        $response["status"] = "error";
        $response["message"] = "An user with the provided phone or email exists!";
        echoResponse(201, $response);
    }
});
$app->post('/newevent',function() use($app) {

    $db = new DbHandler();

    $session=$db->getSession();
    $response = array();
    $r = json_decode($app->request->getBody());
    $name = $r->event->name;
  /**
    $description = $r->newevent->description;
    $contact_phone = $r->newevent->contact_phone;
    $contact_mail = $r->newevent->contact_mail;
    $venue = $r->newevent->venue;
    $city = $r->newevent->city;
    $created_by = $r->newevent->created_by;
    $table_name = "event";
    **/
    if($name!=NULL){
    $json_string='{"username":"'.$name.'"}';
    $rootfile=fopen("json/".$name.".json",'w');
    if(fwrite($rootfile, json_encode($json_string))){
            $response["status"] = "success";
            $response["message"] = "User event created successfully";
            
            echoResponse(200, $response);

    }else{
            $response["status"] = "error";
            $response["message"] = "Failed to create event. Please try again";
    }
    }else{
            $response["status"] = "error";
            $response["message"] = "F Please try again";
    }
    
            
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

$app->get('/logout', function() {
    $db = new DbHandler();
    $session = $db->destroySession();
    $response["status"] = "info";
    $response["message"] = "Logged out successfully";
    echoResponse(200, $response);
});

?>