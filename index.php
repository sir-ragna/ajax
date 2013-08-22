<!DOCTYPE html>

<html>
<head>
    <title>Form test code</title>
    <script type="text/javascript" src="./js/server.js"></script>
    <style type="text/css">
    form, fieldset {
        display: block;
        margin-top: 0px;
        margin-bottom: 0px;
        margin-left: auto;
        margin-right: auto;
        padding: 0px;
        width: 500px;        
    }
    
    legend {
        font-size: 20px;
    }
    
    p label {
        float: left;
        width: 100px;
        text-align: right;
        font-weight: bold;
    }
    
    input {
        width: 300px;
        float: left;
        margin-left: 20px;
    }
    
    div.checkbox p input {
        float: left;
        width: 20px;
    }
    
    p {
        clear: both;
        padding: 5px;
    }
    
    button {
        float: right;
        margin-bottom: 20px;
        margin-right: 20px;
    }
    </style>
</head>

<body>


<form>
    <fieldset>
        <legend>Pakketje Verzenden</legend>
           <p><label for="email">email</label>
            <input type="text" id="email" value="email" /></p>
           <p><label for="start">Afzendplaats</label>
            <input type="text" id="start" value="start" /></p>
           <p><label for="stop">Bestemming</label>
            <input type="text" id="stop" value="stop" /></p>
           <p><label for="title">Titel</label>
            <input type="text" id="title" value="title" /></p>

            <div class="checkbox">
                <p>
                <label for="envelope">envelope</label>
                <input type="radio" name="type" id="envelope" value="envelope" />
                </p>
                <p>
                <label for="box1">box1</label>
                <input type="radio" name="type" id="box1" value="box1" />
                </p>
                <p>
                <label for="box2">box2</label>
                <input type="radio" name="type" id="box2" value="box2" />
                </p>
                <p>
                <label for="box3">box3</label>
                <input type="radio" name="type" id="box3" value="box3" />
                </p>
            </div>
            <button id="btn-verzend" type="button">Verzend post</button>
    </fieldset>
</form>



<script type="application/x-javascript">
    document.getElementById("btn-verzend").onclick = function(target){
        alert("verzonden");
    }
    
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
