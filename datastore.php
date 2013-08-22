<?php

$db_version = "v0.1";

function readDatastore($datastore) {
    $json_str = fread(fopen($datastore, 'r'), filesize($datastore));
    $data =  json_decode($json_str, true);
    $name = $data["name"];
    $version = $data["version"];
    echo "<br>";
    echo $name;
    echo "\n<br>";
    echo $version;
    echo "\n<br><code>";
    echo str_replace("    ", "&nbsp;&nbsp;&nbsp;&nbsp;", str_replace("\n", "<br />" ,$json_str));
    echo "</code>\n<br>";
    echo var_dump($data);
}

function createDatastore($fname, $datstore_name){
    global  $db_version;
    // build minimal datstore
    $data = array("name" => $datstore_name,
                  "version" => $db_version,
                  "users" => array(
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
                               "status" => "ON_WAY"
                               )
                    ) 
                  );
    
    $json_str = json_encode($data, JSON_PRETTY_PRINT);
    
    $fp = fopen($fname, 'w');
    // fwrite ...
    fwrite($fp, $json_str);
    fclose($fp);
}

echo "Testing";
createDatastore("mystore.json", "DATASTORE");
readDatastore("mystore.json");
?>