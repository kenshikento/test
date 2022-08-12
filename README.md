True Compliance Test
--------------------

## Setup  
1. ```composer install ``` 
2. ```cp .env.example .env```
3. ``` php artisan key:generate```
4.  i just used ```php artsian serve ``` for local host.
5. Fill out your db settings and run ``` php artisan migrate```
6. you can default insert your own data by whatever db version you use seeder which you can use ```php artisan migrate:fresh --seed``` which will reset tables and run seeder

## Test
Too run the test you just need run ```php artisan test``` and it will run all the integration testing.

All of the index pages have been set pagination so limit needs to be set and to change page just simply add value in ?limit=10.


## Assumptions
1.Not very clear on what parent property is since it doesn't have its own table(so i assume its self ref) or within questions do we need count parents certificates aswell as the childs. Seeing question doesnt ask for child or parent property certificate i haven't included it in queries 

2.Looking at the data given soft delete do not trigger chain reaction of deletions so i haven't added such functionality. 


## Using Laravel, MySQL and the enclosed data create an API that serves data to the following endpoints:(API)

GET /property                       - Returns properties
GET /property/{id}                  - Returns a property
POST /property                      - Creates a new property
PATCH /property/{id}                - Updates a property
DELETE /property/{id}               - Deletes a property
GET /property/{id}/certificate      - Returns the certificates of a property

GET /property/{id}/note             - Returns the notes of a property
POST /property/{id}/note            - Creates a note for a property

GET /certificate                    - Returns certificates
GET /certificate/{id}               - Returns a certificate
POST /certificate     				- Creates a certificate
GET /certificate/{id}/note          - Returns the notes of a certificate
POST /certificate/{id}/note         - Creates a note for a certificate

## Write a MySQL raw query & eloquent query to get properties which has more than 5 certificates

### Eloquent Query 
-- Currently sit in Test Controller '/local-test', just to show that it works    

``` php 
	return Property::whereHas('certificate', fn($item) => $item, '>', 5)->get();
```

### RAW MYSQL QUERY 
```sql 
select properties.*, count(certificates.id) certificates_count from properties inner join certificates on properties.id = certificates.property_id WHERE properties.deleted_at is null and certificates.deleted_at is null group by properties.id having certificates_count > 5 
```
