<?php require_once('datastore.php'); ?>
<!DOCTYPE html>

<html>
<head>
    <title>testing datastore.php</title>
</head>

<body>

<p>
    <?php
     $array =  Array
    (
    0,
    1,
    2,
    3,
    4
    );

    echo var_dump(array_search(3, array_keys($array)));

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
<h2>Packets</h2>
<p><?php
        $packets = getPacketsByUser("r@vdg.info");
        echo var_dump($packets);
        ?></p>

<h3>Update packet</h3>
<?php
        updatePacket("r@vdg.info", 10, "Bleh");
        ?></p>

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

