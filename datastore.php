<?php

$db_version = "v0.1";

function readDatastore($datastore) {
    $json_str = fread(fopen($datastore, 'r'), filesize($datastore));
    $data =  json_decode($json_str, true);
    return $data;
}

function storePackage($data){
    /* Expected incomming data
    data = array(
                'email' => string 'r@vdg.info' 
                'package' => array(
                      'start' => 'jabbeke' 
                      'stop' =>  'kortrijk' 
                      'title' =>  'eindwerk'
                      )
                )
    */
    $reply = array( "response" => "failed" );
    echo var_dump($data);
    return $reply;
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