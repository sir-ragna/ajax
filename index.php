<!DOCTYPE html>

<html>
<head>
    <title>Form test code</title>
</head>

<body>

<script type="application/x-javascript">
    // include this as a file and then use the server warper object
    var server = {       
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
        // we are only interested in JSON responses atm
        var json_reply = JSON.parse(request.responseText);
        console.log(json_reply);
        // call follow up function and give it our json_reply
        
    } else if (type === "text/html") {
        var html_reply = request.responseText;
        console.log("Received some text/html");
        var p = document.createElement('p');
        p.innerHTML = html_reply;
        document.body.appendChild(p);
    }
});

</script>

</body>
</html>
