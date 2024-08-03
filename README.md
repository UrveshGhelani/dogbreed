Introduction

This Laravel project is a comprehensive system for managing dog breeds, parks, and users. It interacts with a third-party API to fetch dog breed data and allows associations between users, breeds, and parks.


Requirements

▪ PHP 8.x
▪ Laravel 11
▪ mySQL (Database attached)


Routes

---Breed Routes

    GET /breed: Fetch all breeds.
    GET /breed/random: Fetch a random breed. This route has to be assigned before {id} else the api will consider 'random' as one of the {id} of breed
    GET /breed/{id}: Fetch a specific breed by ID.
    GET /breed/{id}/image: Fetch a random image of a specific breed by ID.
    GET /update-breeds: Update breeds from the external API (https://dog.ceo/). Handle has been created with API link to set the Cron jobs to update list(30 min).
    GET /showbreed/{breed}: Show breed details including associated users and parks.

---User Routes

    POST /user/{id}/associate: Associate a park or breed with a user. The Post data will ask for (type = park/breed & type_id = {id} of the respective type)

---Park Routes

    POST /park/{id}/breed: Associate a breed with a park.




