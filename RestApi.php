<?php

/**
 *
 * Class (REST API)
 *
 * @author [ramazancetinkaya]
 * @author [Hazal Güçlü]
 * @date [30.01.2023]
 *
 */

class RestApi
{
    /**
     * @var array $endpoints The list of endpoint names and their handlers
     */
    private array $endpoints = [];

    /**
     * Registers a new endpoint for the API
     *
     * @param string $endpoint The endpoint name
     * @param callable $handler The function that handles the endpoint requests
     *
     * @return void
     */
    public function registerEndpoint(string $endpoint, callable $handler): void
    {
        $this->endpoints[$endpoint] = $handler;
    }

    /**
     * Handles incoming API requests
     *
     * @return void
     */
    public function handleRequest(): void
    {
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            $uri = $_SERVER['REQUEST_URI'];

            // Extract the endpoint name from the URI
            $uriParts = explode('/', $uri);
            $endpoint = $uriParts[1];

            // Check if the endpoint is registered
            if (!array_key_exists($endpoint, $this->endpoints)) {
                throw new Exception('Endpoint not found', 404);
            }

            // Get the parameters from the URI
            $parameters = array_slice($uriParts, 2);

            // Call the endpoint handler
            ($this->endpoints[$endpoint])($method, $parameters);
        } catch (Exception $e) {
            $this->sendErrorResponse($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Sends a JSON error response
     *
     * @param int $status The HTTP status code
     * @param string $message The error message
     *
     * @return void
     */
    public function sendErrorResponse(int $status, string $message): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode(['error' => $message]);
    }

    /**
     * Sends a JSON success response
     *
     * @param mixed $data The response data
     *
     * @return void
     */
    public function sendSuccessResponse($data): void
    {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Parses the request body as JSON
     *
     * @return mixed The parsed JSON data
     */
    public function getRequestData()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid request data', 400);
        }

        return $data;
    }
}
