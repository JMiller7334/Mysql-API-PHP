# MySQL PHP API
This API provides CRUD functionality for managing Customers and Usage Data in a MySQL database. 
Built with PHP and designed for easy interaction via HTTP requests.

## Related Websites
* [JacobJMiller.com](https://JacobJMiller.com).

## Related Projects
* [MySQL API (Express.js)](https://github.com/JMiller7334/mySQL-API)
* [iOS Dashboard App](https://github.com/JMiller7334/iOS-Dashboard-App)
* [Dashboard Database Project](https://github.com/JMiller7334/Dashboard-Database-project)

## Base URL
``https://jacobjmiller.com/api/index``

## Testing with cURL
* Create a New Customer
```sh
curl -X POST "https://jacobjmiller.com/mysql-api/index?customers" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "James",
           "address": "Beyond the Horizon, Starborn Sector",
           "customer_type": "Ethereal Voyager",
           "email": "james@starpath.io",
           "phone": "555-9876"
         }'
```

* Get All Customers
```sh
curl -X GET "https://jacobjmiller.com/mysql-api/index?customers"
```

* Update a Customer
```sh
curl -X PUT "https://jacobjmiller.com/mysql-api/index?customers&id=2" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Mark Nova",
           "address": "Galactic Edge, Orion Belt",
           "customer_type": "Celestial Wanderer",
           "email": "nova@galaxytravel.io",
           "phone": "555-5555"
         }'

```

* Delete a Customer
```sh
curl -X DELETE "https://jacobjmiller.com/mysql-api/index?customers&id=2"
```

**Notes**
* Replace {customerId} and {usageId} with actual IDs.

## Endpoints
### Customers
**Get All Customers**

* URL: ``https://jacobjmiller.com/mysql-api/index?customers``
* Method: ``GET``
* Response Code: ``200 OK``
* Response Example:
```` json
[
  {
    "id": 1,
    "name": "John Doe",
    "address": "123 Main St, Springfield",
    "customer_type": "Premium",
    "email": "johndoe@example.com",
    "phone": "555-1234"
  },
  ...
]
````

**Get Customer by ID**
* URL: ``https://jacobjmiller.com/mysql-api/index?customers&id={customerId}``
  * Example: ``https://jacobjmiller.com/mysql-api/index?customers&id=1``
* Method: ``GET``
* Response Code: ``200 OK`` (if found), ``404 Not Found`` (if customer does not exist)
* Response Example:
```` json
  {
    "id": 1,
    "name": "John Doe",
    "address": "123 Main St, Springfield",
    "customer_type": "Premium",
    "email": "johndoe@example.com",
    "phone": "555-1234"
  }
````


**Create a New Customer**
* URL: ``https://jacobjmiller.com/mysql-api/index?customers``
* Method: ``POST``
* Headers:
```` json
{
  "Content-Type": "application/json"
}
````
* Body Example:
````json
{
  "name": "Chey",
  "address": "Beyond the Horizon, Starborn Sector",
  "customer_type": "Ethereal Voyager",
  "email": "chey@starpath.io",
  "phone": "555-9876"
}
````
* Response Code: ``201 Created``
* Response: ``true``


**Update a Customer**
* URL: ``https://jacobjmiller.com/mysql-api/index?customers&id={customerId}``
* Method: ``PUT``
* Response Code: ``200 OK`` (if updated), ``404 Not Found`` (if customer does not exist)
* Body Example:
````json
{
  "name": "Chey Nova",
  "address": "Galactic Edge, Orion Belt",
  "customer_type": "Celestial Wanderer",
  "email": "nova@galaxytravel.io",
  "phone": "555-5555"
}
````
* Response: ``true``


**Delete a Customer**
* URL: ``https://jacobjmiller.com/mysql-api/index?customers&id={customerId}``
* Method: ``DELETE``
* Response Code: ``204 No Content`` (if deleted), ``404 Not Found`` (if customer did not exist)
* Success Response: ``No response``
* Failure Response:
``` json
{
  "error": "Customer not found"
}
```

### Usage Data
**Get Usage Data by Customer ID**
* URL: ``https://jacobjmiller.com/mysql-api/index?usage&customerId={customerId}``
  * Example: ``https://jacobjmiller.com/mysql-api/index?usage&customerId=1``
* Method: ``GET``
* Response Code: ``Code: 200 OK`` (if found), ``404 Not Found`` (if no usage data exists)
* Response:
```` json
[
  {
    "id": 1,
    "customerId": 1,
    "usage_month": "2024-08",
    "customer_usage": 123.45
  },
  ...
]
````


**Create New Usage Data**
* URL: ``https://jacobjmiller.com/mysql-api/index?usage``
* Method: ``POST``
* Response Code: ``201 Created``
* Body Example:
```` json
  {
    "customerId": 1,
    "usage_month": "2024-08",
    "customer_usage": 123.45
  }
````
* Response: ``true``


**Update Usage Data**
* URL: ``https://jacobjmiller.com/mysql-api/index?usage&id={usageId}``
* Method: ``PUT``
* Response Code: ``200 OK`` (if updated), ``404 Not Found`` (if usage data does not exist)
* Body Example:
```` json
  {
    "customerId": 1,
    "usage_month": "2024-08",
    "customer_usage": 123.45
  }
````
* Response: ``true``


**Delete Usage Data**
* URL: ``https://jacobjmiller.com/mysql-api/index?usage&id={usageId}``
* Method: ``DELETE``
Response Code: ``204 No Content`` (if deleted), ``404 Not Found`` (if usage data does not exist)
Success Response: ``No response``
Failure Response:
```
 "error": "Usage data not found"
```

### Error Responses
**Status Code	Meaning	Example Response**
* ``200 OK``	Request was successful.
* ``201 Created``	Resource was successfully created	``true``
* ``400 Bad Request``	Invalid request parameters	`` { "error": "Invalid JSON data" }``
* ``404 Not Found``	Resource does not exist	``{ "error": "Customer not found" }``
* ``404 Not Found`` Invalid endpoint ``{ "error": "Invalid ${METHOD} endpoint, please check your URL" }``
* ``405 Method Not Allowed`` Unknown or not allowed method ``{"error": "Method not allowed or unknown"}``
