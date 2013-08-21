

# Client server communication

## Client to server

Note the main goal of this school project was to create an *animated HTML5* website. I do not count in authentication and this will basically be potentially most exploitable code ever written. I ignore comments about security, I know it's shit but this is just for a demo. Comments about code quality in general are welcome though.

### Example

### getting info about all packages

-> client sends

	{ action : "ALL" }

-> server response

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

### Getting specific packag info

-> client sends

	{ action : "QUERY",
	  query  : "102" }
 
 -> server response

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

### Storing a package info

-> client sends

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

-> server responds

	{ respons : "SUCCES",
	  id : 430
	}

Response can be ["SUCCES", "FAILED", "DUPLICATE", "UPDATED"]

### Updating package info

-> client sends

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

Package status can be ["TO_PICKUP", "ON_WAY", "DELIVERED"]

### Deleting package info

For deleting, the user is currently optional. Might build in a password, or not. This is a visual demo after al.

-> client sends

	{ action "DELETE",
	  id : 340,
	  user : r@vdg.org,
	  pass : butterfly
	}

## Data-storage of packages


