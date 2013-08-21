<!DOCTYPE html>

<html>
<head>
    <title>Form test code</title>
    <script type="text/javascript" src="./js/server.js"></script>
</head>

<body>

<script type="application/x-javascript">

// some json data
var data = {
    person: {
        name : "Robbe",
        age : 22,
    }
};

// send our JSON
server.sendJSON("json.php", data, function(request){
    // receive reply
    var type = request.getResponseHeader("Content-Type").toLowerCase();
    
    if (type === "application/json") {
        // If we get JSON
        var json_reply = JSON.parse(request.responseText);
        console.log(json_reply); // log JSON we received to the console
        
        // YOUR CODE HERE (that uses json_reply)
        
    } else if (type === "text/html") {
        // the server returned HTML. This might be an error.
        // To display this errer we append it to the document body.
        var html_reply = request.responseText;
        console.log("Received some text/html");
        var p = document.createElement('div');
        p.innerHTML = html_reply;
        document.body.appendChild(p);
    }
});

</script>

</body>
</html>
