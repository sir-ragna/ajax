
# Client server communication

## Client to server

Note the main goal of this school project was to create an *animated HTML5* website. I do not count in authentication and this will basically be potentially most exploitable code ever written. I ignore comments about security, I know it's shit but this is just for a demo. Comments about code quality in general are welcome though.

### Example

### getting info about all packages

- client sends

```json
{ action : "ALL" }
```

- server response

```json
{ response : [
		{ id : 101,
		  email: "r@vdg.info",
		  package : {
				start : "Jabbeke",
				stop  : "Assebroek",
				type  : "envelope",
				title : "Love letter"
				date  : 20130713,
				status : "DELIVERED"
		  }
		},
		{ id : 102,
		  email: "r@vdg.info",
		  package : {
				start : "Jabbeke",
				stop  : "Brugge",
				type  : "envelope",
				title : "party invite",
				date  : 20130705,
				status : "ON_WAY"
		  }
		},
		{ id : 105,
		  email: "i@dv.info",
		  package : {
				start : "Assebroek",
				stop  : "Kortrijk",
				type  : "envelope",
				title : "greetings",
				date  : 20130716,
				status : "TO_PICKUP"
		  }
		}
	]
}
```

Package status can be ["TO_PICKUP", "ON_WAY", "DELIVERED"]

### Getting specific packag info

- client sends

```json
{ action : "QUERY",
  query  : "102" }
```
 - server response

```json
{ response : { id : 102,
		  email: "r@vdg.info",
		  package : {
				start : "Jabbeke",
				stop  : "Brugge",
				type  : "envelope",
				title : "party invite",
				date  : 20130705,
				status : "ON_WAY"
		  }
		}
}
```

### Storing a package info

- client sends

```json
{ action : "STORE",
  data   : {
		email: "r@vdg.org",
		  package : {
				start : "Jabbeke",
				stop  : "Brugge",
				type  : "envelope",
				title : "party invite",
				status : "TO_PICKUP"
		  }
  }
}
```

- server responds

```json
{ response : "SUCCES",
  id : 430
}
```

Or on failure

```json
{ response : "FAILED" }
```

Response can be ["SUCCES", "FAILED", "DUPLICATE", "UPDATED"]

### Updating package info

- client sends

```json
{ action : "UPDATE",
  id : 430,
  data   : {
		email: "r@vdg.org",
		  package : {
				start : "Jabbeke",
				stop  : "Brugge",
				type  : "envelope",
				title : "party invite",
				status : "ON_WAY"
		  }
}
```

### Deleting package info

For deleting, the user is currently optional. Might build in a password, or not. This is a visual demo after al.

- client sends

```json
{ action : "DELETE",
  id : 340,
  user : r@vdg.org,
  pass : butterfly
}
```

## Data-storage of packages

The data is stored in text as json
```json
{ name : "JSON DATASTORE",
  version: "v0.1",
  users : [
		{ "r@vdg.info" : [	{ id : 430,
							   start : "...",
							   stop  : "...",
							   type  : "...",
							   title : "...",
							   status : "..."
							 },
							 { id : 425,
							   start : "...",
							   stop  : "...",
							   type  : "...",
							   title : "...",
							   status : "..."						 
							 }
						 ]
		},
		{ users : packages},
		{ ... },
		{}
	]
}
```

Said json is constructed en deconstructed in PHP with the following code.
```PHP
$data = array("name" => $datstore_name,
			  "version" => $db_version,
			  "users" => array(
						"r@vdg.info" => array(
							array( "id" => 430,
								   "start" => "Jabbeke",
								   "stop"  => "Brugge",
								   "type"  => "envelope",
								   "title" => "Love letter",
								   "status" => "ON_WAY"
								   ),
							array( "id" => 425,
								   "start" => "Jabbeke",
								   "stop"  => "Brugge",
								   "type"  => "envelope",
								   "title" => "Love letter",
								   "status" => "DELIVERED"
								   )
						),
						"i@dv.info" => array(
							array( "id" => 530,
								   "start" => "Brugge",
								   "stop"  => "Jabbeke",
								   "type"  => "envelope",
								   "title" => "re:Invitation",
								   "status" => "TO_PICKUP"
								   ),
							array( "id" => 402,
								   "start" => "Brugge",
								   "stop"  => "Jabbeke",
								   "type"  => "envelope",
								   "title" => "Stop stalking me",
								   "status" => "ON_WAY"
								   )
						)
					) 
			 );
```