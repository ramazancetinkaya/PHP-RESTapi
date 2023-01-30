# PHP-REST-API
REST API class

## Here's an example:

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

This example registers a single endpoint that handles GET requests to the /users URL. When this endpoint is called, the function passed as the third argument will be executed, and the response data returned from the function will be returned as the endpoint response.

To make a request to the API, you can use a tool such as curl or Postman, or you can use a HTTP client library in your programming language of choice. The request URL would be the base URL of the API (e.g. http://localhost/api/) plus the endpoint URL (e.g. /users). The request method would be GET, as specified in the endpoint registration.
