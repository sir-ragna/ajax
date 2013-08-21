<!DOCTYPE html>

<html>
<head>
    <title>Form test code</title>
</head>

<body>

<script type="application/x-javascript">
    // server wrapper object
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

// what data do we want to send?
var data = {
    person: {
        name : "Robbe",
        age : 22,
    }
};

server.sendJSON("json.php", data, function(request){
    var type = request.getResponseHeader("Content-Type");
    
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
