# PHP REST API

REST (Representational State Transfer) is a software architectural style for building web services. REST APIs (Application Programming Interfaces) provide a way for different systems to communicate over the internet by sending requests to retrieve or manipulate data. REST APIs use HTTP methods such as GET, POST, PUT, DELETE to operate on resources identified by URIs (Uniform Resource Identifiers). REST APIs are commonly used for web-based applications, mobile applications, and microservices.

_Before we begin, this class may not be the final version, changes and additions may be made._

## Example Usage:

```php
// Require the REST API class
require_once 'RestApi.php';

// Create an instance of the REST API class
$api = new RestApi();

// Register an endpoint
$api->registerEndpoint('GET', '/users', function ($params) {
    // Your endpoint logic here
    return ['users' => [
        ['id' => 1, 'name' => 'User 1'],
        ['id' => 2, 'name' => 'User 2'],
        ['id' => 3, 'name' => 'User 3'],
    ]];
});

// Start the API
$api->start();
```

This example registers a single endpoint that handles GET requests to the **/users** URL. When this endpoint is called, the function passed as the third argument will be executed, and the response data returned from the function will be returned as the endpoint response.

To make a request to the API, you can use a tool such as curl or Postman, or you can use a HTTP client library in your programming language of choice. The request URL would be the base URL of the API (e.g. **http://localhost/api/**) plus the endpoint URL (e.g. **/users**). The request method would be **GET**, as specified in the endpoint registration.

### Authors

**Ramazan Çetinkaya**

- [github/ramazancetinkaya](https://github.com/ramazancetinkaya)

### Special Thanks
Thanks to **<a href="#">Hazal Güçlü</a>** for her support in development.

### License

Copyright © 2023, [Ramazan Çetinkaya](https://github.com/ramazancetinkaya).
