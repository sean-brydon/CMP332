# CMP332

**To enable XML return please pass xml=true as a flag at the end of the route**
e.g. movies?xml=true


** To user any Create, Update, Delete functions please provide the query key to the request called token 'token' with the JWT issues from logging in**
movies?token={token goes here}
** this would be sent in headers in a real world situation however, the apache server needs some config to get headers setup**
## Routes
-- Movies -- 
* GET movies
* GET movies/{id}
* PUT movies/{id} - With post body 
* POST movies - With post body 
* DELETE movies/{id}

* POST auth/login - With Post Body - Returns JWT token

## Post body format
-- Movies -- 
{
	"title":"string",
	"ageRating": int,
	"movieRating": int,
	"releaseDate": "dd-mm-yyyy",
	"description":"string",
	"genre": "sting",
	"director":"string"
}
-- Auth Login -- 
{
	"username":"sean4755",
	"password":"Password99!"
}

