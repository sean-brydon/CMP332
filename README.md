# CMP332

**To enable XML return please pass xml=true as a flag at the end of the route**
e.g. movies?xml=true

## Routes
-- Movies -- 
* GET movies
* GET movies/{id}
* PUT movies/{id} - With post body 
* POST movies - With post body 
* DELETE movies/{id}



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

