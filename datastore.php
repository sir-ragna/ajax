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
    $user_id = $data['last_packet_id']++;
    $users_emails = array_keys($data['users']);
    
    if (in_array($package['email'], $users_emails)) {
        $email = $package['email'];
        array_push($data['users'][$email], array(
                        "id" => $user_id,
                        "start" => $package['package']['start'],
                        "stop"  => $package['package']['stop' ],
                        "title" => $package['package']['title'],
            // not yet implemented TODO "type"  => $package['package']['type' ],
                        "STATUS" => "TO_PICKUP"
                ));
    }
    
    writeToDB($data);

    $reply = array( "status" => "SUCCES",
                    "id" => $user_id);

    
    return $reply;
}

function getAllIDs(){
    /* Here's where performance goes to DIE */
    global $db_name;
    $data = readDatastore($db_name);
    
    $IDs = array();
    
    foreach ($data['users'] as $users) {
      echo "<h4>users</h4>";
      echo var_dump($users);
        foreach ($users as $email => $pack) {
           echo "<h4>pack</h4>";
           echo var_dump($pack);
           array_push($IDs, $pack['id']);
          
        }
    }

    return $IDs;
    
}

//
function getPacketsByUser($userEmail){
  
  global $db_name;
  $data = readDatastore($db_name);

  $packets = array();

  foreach($data['users'] as $email => $userPackets){

    if(strtoupper($email) == strtoupper($userEmail)){
        foreach($userPackets as $packet){
            array_push($packets, $packet);
        }
    }

  }

  return $packets;
    
}

function updatePacket($email, $packetId, $newStatus){
  global $db_name;
  $data = readDatastore($db_name);

  foreach($data['users'][$email] as $packet){
    if($packet['id']==$packetId) {
      echo var_dump(array_search($packet, array_keys($data['users'][$email])));


        $index = array_search($packet, array_keys($data['users'][$email]));

        var_dump($packet);
        //TODO: check gettype van $index
        // it might be a boolean false, in case the e-mail is not found
        // !!!!!!
        $data['users'][$email][$index]['status'] = $newStatus;
    }
  }

  writeToDB($data);

}

function createDatastore($fname, $datstore_name){
    global  $db_version;
    // build minimal datstore
    $data = array("name" => $datstore_name,
                  "version" => $db_version,
                  "last_packet_id" => 100,
                  "users" => array(
                            "r@vdg.info" => array(
                                array( "id" => 10,
                                       "start" => "Jabbeke",
                                       "stop"  => "Brugge",
                                       "type"  => "envelope",
                                       "title" => "Love letter",
                                       "status" => "ON_WAY"
                                       ),
                                array( "id" => 11,
                                       "start" => "Jabbeke",
                                       "stop"  => "Brugge",
                                       "type"  => "envelope",
                                       "title" => "Love letter",
                                       "status" => "DELIVERED"
                                       )
                            ),
                            "i@dv.info" => array(
                                array( "id" => 12,
                                       "start" => "Brugge",
                                       "stop"  => "Jabbeke",
                                       "type"  => "envelope",
                                       "title" => "re:Invitation",
                                       "status" => "TO_PICKUP"
                                       ),
                                array( "id" => 13,
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

function writeToDB($data) {
  global $db_name;
  $json_str = json_encode($data, JSON_PRETTY_PRINT);
  
  $fp = fopen($db_name, 'w');
  // fwrite ...
  fwrite($fp, $json_str);
  fclose($fp);
}

?>