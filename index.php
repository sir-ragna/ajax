<!DOCTYPE html>

<html>
<head>
    <title>Form test code</title>
    <script type="text/javascript" src="./js/DEBUG.js"></script>
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
            <input type="text" id="email" value="r@vdg.info" /></p>
           <p><label for="start">Afzendplaats</label>
            <input type="text" id="start" value="jabbeke" /></p>
           <p><label for="stop">Bestemming</label>
            <input type="text" id="stop" value="kortrijk" /></p>
           <p><label for="title">Titel</label>
            <input type="text" id="title" value="eindwerk" /></p>

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
        createPackage();
    };
    
    var createPackage = function(){
        // TODO VALIDATION
        var query = { action : "STORE",
                     data : {}
            };
        
        query.data.email = document.getElementById("email").value;
        query.data.package = {};
        query.data.package.start = document.getElementById("start").value;
        query.data.package.stop  = document.getElementById("stop").value;
        query.data.package.title = document.getElementById("title").value;
        
        
        server.sendJSON("json.php", query, callbackBoilerplate(function(response){
            // TODO handling of the response
            DEBUG("replied (^_^)");
            DEBUG(response);
            
            if (response['response']) {
                //code
            }
            }));
        
    };
    
    // TODO CRUD
    var updatePackage = function(){};
    var removePackage = function(){};
    
    /* callbackBoilerplate, gives back a function that check if the request
     * object actually contains a JSON response , calls the argument function
     * if so.
    */
    var callbackBoilerplate = function(func){
        
        var append_error_to_html = function(input, header_type){
            // We received the wrong header or could not parse the input JSON
            // Append possible error message to our body.
            console.log("Received header type: " + header_type);
            var div = document.createElement('div');
            div.classList.add("error");
            div.innerHTML = input;
            document.body.appendChild(div);
        }
        
        return (function(request){
            // Get headers and input
            var type = request.getResponseHeader("Content-Type").toLowerCase();
            var input = request.responseText;
            
            // print them for debugging purposes
            DEBUG("Content-Type: " + type);
            DEBUG("CONTENT: " + input);
         
            // do the headers give json?            
            if (type === "application/json") {
                try {
                    var json_reply = JSON.parse(input);
                    func(json_reply);
                } catch(e) {
                    DEBUG(e.message);
                    DEBUG("Not Actually JSON");
                    append_error_to_html(input, type);
                }                
            } else {
                DEBUG("Expected JSON header");
                append_error_to_html(input, type);
            }
        });
       
    };
    
</script>

</body>
</html>
