<?php require_once('datastore.php'); ?>
<!DOCTYPE html>

<html>
      <head>
            <title>testing datastore.php</title>
      </head>

      <body>
            <h1>Get your packet here:</h1>
            <?php 
                  echo var_dump(getPacketById(12));
            ?>

            <h1>Get all the packetnumbers you can find</h1>
            <?php 
                  echo var_dump(getAllPacketIDs());
            ?>

            <h1>Steal your users packets</h1>
            <?php 
                  echo var_dump(getPacketsByUser('i@dv.info'));
            ?>
      </body>

</html>