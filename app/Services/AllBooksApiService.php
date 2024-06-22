<?php

// Defines the namespace for this service. It helps in organizing and grouping classes logically within the application.
namespace App\Services;

// Imports the ConsumesExternalService trait, which likely contains methods for interacting with external APIs.
use App\Traits\ConsumesExternalService;

// Declares the AllBooksApiService class.
class AllBooksApiService
{
    use ConsumesExternalService; // Uses the ConsumesExternalService trait within this service, giving access to its methods.

    /**
     * The base URI to consume the All Books API service.
     *
     * @var string
     */
    public $baseUri;

    /**
     * Create a new instance of AllBooksApiService.
     *
     * @return void
     */
    public function __construct()
    {
        // Sets the base URI for the All Books API service by retrieving it from the configuration.
        $this->baseUri = config('services.allBooksApi.base_uri');
    }

    /**
     * Obtain the book details by title from the All Books API.
     *
     * @param string $title The title of the book to search for.
     * @return string The response from the API, usually JSON or XML data.
     */
    public function obtainBook($title)
    {
        // Constructs the full URL to request details for a specific book title.
        $url = "{$this->baseUri}/title/" . rawurlencode($title);

        // Sets the required headers for the API request.
        $headers = [
            'x-rapidapi-key' => config('services.rapidApiKey.api_key'), // API key for authentication.
            'x-rapidapi-host' => parse_url($this->baseUri, PHP_URL_HOST), // Hostname extracted from the base URI.
        ];

        // Performs the HTTP GET request using the performRequest method from the ConsumesExternalService trait.
        return $this->performRequest('GET', $url, [], $headers);
    }
}
