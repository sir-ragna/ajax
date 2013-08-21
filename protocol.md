

# Client server communication

## Client to server

### Example

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



	
## Datastorage of packages

