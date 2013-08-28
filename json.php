<?php

//header('Access-Control-Allow-Origin: http://student.howest.be/robbe.van.der.gucht/fedex/');
//header('Access-Control-Allow-Origin: http://localhost/');

require_once('datastore.php');


    
// Check if the type headers are set
if (isset($_SERVER['CONTENT_LENGTH']) && isset($_SERVER['CONTENT_TYPE'])){
    $type = $_SERVER['CONTENT_TYPE'];
    $length = $_SERVER['CONTENT_LENGTH'];
    

    
    // check content type en length
    if ( "application/json" == strtolower(explode(';', $type)[0])
        && $length > 5 && $length < 256){
        // we do have incomming JSON

        // read raw POST data
        // yes this is the prefered method:
        // http://www.php.net/manual/de/wrappers.php.php
        
        try {
            $input = file_get_contents('php://input');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        // Handle JSON in PHP:
        // http://nitschinger.at/Handling-JSON-like-a-boss-in-PHP
                
        $request = json_decode($input, true); // true -> array
                                              // false -> object
                                              // use array so true
        $reply = "";

        // Determine what to do.
        if (array_key_exists("action", $request)) {
            $action = $request["action"];
            $action = strtoupper($action);
            
            if ("STORE" == $action){
                $reply = storePackage($request["data"]);
            }
            
            if ("ALL" == $action){
                $reply = readDatastore("data.json");
                $reply['status'] = "SUCCES";
            }
            
        } else {
            header('Content-Type: text/html');
            echo "<p>No Action Found</p>";
            echo var_dump($request);
            exit();
        }
        
        header('Content-Type: application/json');      
        echo json_encode($reply); // send JSON
        exit();
    } else {
        header('Content-Type: text/html');
        echo "<span class='error'>Only accept JSON with correct headers</span>";
        echo "<span class='error'>Or JSON cannot be $length characters</span>";
        exit();
    }    
}
header('Content-Type: text/html');
echo "Problem?";
?>