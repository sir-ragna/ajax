<?php require_once('datastore.php'); ?>
<!DOCTYPE html>

<html>
<head>
    <title>testing datastore.php</title>
</head>

<body>

<h1>test, getPacketById</h1>
<p>
    <?php
     echo getPacketById('r@vdg.info','10');
    ?>
 </p>

<h1>Testing the datastore.php functions</h1>

<p><?php createDatastore("data.json", "DATASTORE"); ?></p>
<p><?php

    $data = readDatastore("data.json");
    $json_str = json_encode($data, JSON_PRETTY_PRINT);
    $name = $data["name"];
    $version = $data["version"];
    echo "<h2>Name: $name</h2>\n<h2>Version: $version</h2>\n<code>\n";
    echo str_replace("    ", "&nbsp;&nbsp;&nbsp;&nbsp;",
                        str_replace("\n", "<br />" ,$json_str));
    echo "\n</code>\n<br />";
    echo "<h3>Data dump</h3>";
    echo var_dump($data);
    
    ?></p>

</body>
</html>

