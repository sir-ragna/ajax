<?php

// if we have a data request
if (isset($_POST["data"])){
    $data = urldecode($_POST["data"]);
    //var_dump($_POST);
    
    // if we wanted to access the json data from inside PHP as we probably don't
    // want to just overwrite our datafile with incomming JSON.
    // We will want to nest the incomming JSON in other JSON. In order to use
    // JSON as data in PHP we'll need:
    //$data = json_decode($_POST["data"]);
    
    
    // Write to file
    $file = 'data.json';    
    $fp = fopen($file, 'w');    
    fwrite($fp, $data);    
    fclose($fp);


    
    // If we'd like to send something back we could echo anything.
    $reply_string = "Hello there!";
    echo $reply_string;
  
    // http://php.net/manual/en/function.json-decode.php
    // ^ json_decode is a pain in the ass because they redefine what 'valid'
    // JSON actually is. 
    //echo var_dump(json_decode("{person:{name:'robbe',age:22},stuff:['a','b']}"));
    // after we send our reply. We should stop execution.
    // Otherwise we will echo the rest of the HTML
    exit;
}

?>

<!DOCTYPE html>

<html>
<head>
    <title>Form test code</title>
</head>

<body>

<script type="application/x-javascript">
    var server = {
        /* generic POST */
        do : function(params){
            /* Params are object
             *  { url : "index.php",
             *    callback : function(e){},
             *    method : "POST",
             *    type : "application/x-www-form-urlencoded"},
             *    isRawJSON : true,
             *    data : { name : "Me" }
            */
            var request = new XMLHttpRequest();
            var url = params.url || "index.php";
            var method = params.method || "POST";
            var type = params.type || "application/x-www-form-urlencoded";
            var isRawJSON = (params.isRawJSON === undefined) || true;
            var callback = function(e){
                if (e.target.readyState === 4 && e.target.status === 200) {
                    // call calback only if response returned
                    params.callback(e.target);
                }       
            }
            // if we have raw-json on our hands, let's stringify
            var data = isRawJSON ? JSON.stringify(params.data) : params.data;
            data =  "data=" + encodeURIComponent(data); // encode URI style.
            
            request.onreadystatechange = callback;
            request.open(method, url); // true -> async || false -> sync
            request.setRequestHeader("Content-type", type);
            request.setRequestHeader("Content-length", data.length);
            
            // send response
            request.send(data);
            
        },
        
        sendJSON : function (url, data, callback){
            var request = new XMLHttpRequest();
            request.open("POST", url);
            request.onreadystatechange = function(){
                if (request.readyState === 4 && callback != undefined) {
                    callback(request);
                }
            };
            request.setRequestHeader("Content-Type", "application/json");
            request.send(JSON.stringify(data));
        }
    };
</script>
<script type="application/x-javascript">

// what data do we want to send?
var data = {
    person: {
        name : "Robbe",
        age : 22,
    }
};

// what is our callback?
var callback = function(e){
    console.log("Response text and such : ");
    console.log(e.responseText);
    var type = e.getResponseHeader("Content-Type");
    if (type.match(/^text/)) {
        // we've got some text incomming
        
        // reply message; extract the text from the response
        var reply_text = e.responseText;
        
        // Because we don't know what to do, we will just
        // append the reply message to our html document.
        // Of course we won't do this if we had ourselves
        // some JSON returned that we would like to parse
        // and use in our Javascript.
        var msg = document.createElement("p");
        msg.innerHTML = reply_text;
        document.body.appendChild(msg);
        
    }
};

// now call our server object with the parameters nested in an object
var params = {data: data, callback : callback};
// server.do(params);

server.sendJSON("json.php", data, function(request){
    var type = request.getResponseHeader("Content-Type");
    
    console.log(type);
    if (type === "application/json") {
        // we are only interested in JSON responses atm
        var json_reply = JSON.parse(request.responseText);
        console.log(json_reply);
    } else if (type === "text/html") {
        var html_reply = request.responseText;
        console.log("Received some text/html");
    }
});

</script>

</body>
</html>
