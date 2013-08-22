<!DOCTYPE html>

<html>
<head>
    <title>Form test code</title>
    <script type="text/javascript" src="./js/server.js"></script>
    <style type="text/css">
    .form {
        display: block;
        margin-top: 0px;
        margin-bottom: 0px;
        margin-left: auto;
        margin-right: auto;
        padding: 0px;
        width: 480px;        
    }
    .input-keys, .input-values {
        margin: 0px;
        padding: 0px;
        width: 240px;
        float: left;
    }
    
    .input-keys label, .input-values input {
        float: none;
        display: inline;
        margin: 0px;
        padding: 0px;
        height: 30px;
        width: 200px;
        text-align: left;
        vertical-align: text-bottom;
        
    }
    </style>
</head>

<body>


<div class="form">
    <div class="input-keys">
        <label for="email">email</label>
        <label for="start">Afzendplaats</label>
        <label for="stop">Bestemming</label>
        <label for="envelope">envelope</label>
        <label for="box1">box1</label>
        <label for="box2">box2</label>
        <label for="box3">box3</label>
        <label for="title">Titel</label>
    </div>
    <div class="input-values">
        <input type="text" id="email" value="email" />
        <input type="text" id="start" value="start" />
        <input type="text" id="stop" value="stop" />
        <div class="checkbox">
            <input type="radio" name="type" id="envelope" value="envelope" />
            <input type="radio" name="type" id="box1" value="box1" />
            <input type="radio" name="type" id="box2" value="box2" />
            <input type="radio" name="type" id="box3" value="box3" />
        </div>
        <input type="text" id="title" value="title" />
    </div>
</div>



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
