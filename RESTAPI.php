<?php

class RESTAPI {
    // Define HTTP version
    private $httpVersion = "HTTP/1.1";

    public function __construct(){
        // Initialize any necessary resources or dependencies here
    }

    public function processAPI($url){
        // Get the request method
        $method = $_SERVER['REQUEST_METHOD'];

        // Extract the endpoint and arguments from the URL
        $request = explode('/', trim($url,'/'));
        $endpoint = array_shift($request);
        if (array_key_exists(0, $request) && !is_numeric($request[0])) {
            $verb = array_shift($request);
        }
        $args = $request;

        // Check if the endpoint exists and call it, return the response
        if (method_exists($this, $endpoint)) {
            return $this->_response($this->$endpoint($verb, $args));
        }
        return $this->_response("No Endpoint: $endpoint", 404);
    }

    private function _response($data, $status = 200) {
        // Set the response HTTP status code and message
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));

        // Return the response data as JSON
        return json_encode($data);
    }

    private function _requestStatus($code){
        // Define the HTTP status codes and messages
        $status = array(  
            200 => 'OK',
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ); 
        return ($status[$code])?$status[$code]:$status[500]; 
    }

    // Example endpoint
    protected function example($verb, $args){
        if ($verb == 'GET') {
            if (count($args) > 0) {
                return array("example" => $args[0]);
            } else {
                return array("example" => "This is an example endpoint.");
            }
        } else {
            return array("error" => "Invalid request method.");
        }
    }
}
