<?php

$db_version = "v0.1";
$db_name = "data.json";

function readDatastore($datastore) {
    $json_str = fread(fopen($datastore, 'r'), filesize($datastore));
    $data =  json_decode($json_str, true);
    return $data;
}

function storePackage($package){
    global $db_name;
    /* Expected incomming data
    $package = array(
                'email' => 'r@vdg.info' 
                'package' => array(
                      'start' => 'jabbeke' 
                      'stop' =>  'kortrijk' 
                      'title' =>  'eindwerk'
                      )
                )
    */
    $reply = array( "status" => "FAILED",
                    "reason"   => "Didn't feel like it.");
    //echo var_dump($data);
    
    // read in data
    $data = readDatastore($db_name);
    // check if user exists, otherwise ad
    $users_emails = array_keys($data['users']);
    
    if (in_array($package['email'], $users_emails)) {
        $email = $package['email'];
        array_push($data['users'][$email], array(
                        "start" => $package['package']['start'],
                        "stop"  => $package['package']['stop' ],
                        "title" => $package['package']['title'],
            // not yet implemented TODO "type"  => $package['package']['type' ],
                        "STATUS" => "TO_PICKUP"
                ));
    }
    
    $reply["users"] = $users_emails; // for debugging(temporary)
    // add package to DB
    
    
    return $reply;
}

function getAllIDs(){
    /* Here's where performance goes to DIE */
    global $db_name;
    $data = readDatastore($db_name);
    
    $IDs = array();
    
    foreach (array_values($data['users']) as $pack) {
        array_push($IDs, $pack['id']);
    }
    
    return IDs;
    
}

function createDatastore($fname, $datstore_name){
    global  $db_version;
    // build minimal datstore
    $data = array("name" => $datstore_name,
                  "version" => $db_version,
                  "users" => array(
                            "r@vdg.info" => array(
                                array( "id" => 430,
                                       "start" => "Jabbeke",
                                       "stop"  => "Brugge",
                                       "type"  => "envelope",
                                       "title" => "Love letter",
                                       "status" => "ON_WAY"
                                       ),
                                array( "id" => 425,
                                       "start" => "Jabbeke",
                                       "stop"  => "Brugge",
                                       "type"  => "envelope",
                                       "title" => "Love letter",
                                       "status" => "DELIVERED"
                                       )
                            ),
                            "i@dv.info" => array(
                                array( "id" => 530,
                                       "start" => "Brugge",
                                       "stop"  => "Jabbeke",
                                       "type"  => "envelope",
                                       "title" => "re:Invitation",
                                       "status" => "TO_PICKUP"
                                       ),
                                array( "id" => 402,
                                       "start" => "Brugge",
                                       "stop"  => "Jabbeke",
                                       "type"  => "envelope",
                                       "title" => "Stop stalking me",
                                       "status" => "ON_WAY"
                                       )
                            )
                        ) 
                 );
    
    $json_str = json_encode($data, JSON_PRETTY_PRINT);
    
    $fp = fopen($fname, 'w');
    // fwrite ...
    fwrite($fp, $json_str);
    fclose($fp);
}

?>