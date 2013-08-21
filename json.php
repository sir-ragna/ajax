<?php

// read raw POST data
// yes this is the prefered method:
// http://www.php.net/manual/de/wrappers.php.php
$input = file_get_contents('php://input');

// Handle JSON in PHP:
// http://nitschinger.at/Handling-JSON-like-a-boss-in-PHP
$json = json_decode($input);

// set the appriorate header
header('Content-Type: application/json');

// send JSON
echo json_encode($json);

?>