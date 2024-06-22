<?php

// Defines the namespace for this service. It helps in organizing and grouping classes logically within the application.
namespace App\Services;

// Imports the ConsumesExternalService trait, which likely contains methods for interacting with external APIs.
use App\Traits\ConsumesExternalService;

// Declares the BookFinderService class.
class BookFinderService
{
    use ConsumesExternalService; // Uses the ConsumesExternalService trait within this service, giving access to its methods.

    /**
     * The base URI to consume the Book Finder service.
     *
     * @var string
     */
    public $baseUri;

    /**
     * Create a new instance of BookFinderService.
     *
     * @return void
     */
    public function __construct()
    {
        // Sets the base URI for the Book Finder service by retrieving it from the configuration.
        $this->baseUri = config('services.bookFinder.base_uri');
    }

    /**
     * Search for books using Book Finder API.
     *
     * @param string|null $series Optional: Series name to search for.
     * @param string|null $bookType Optional: Type of book to search for.
     * @param string|null $author Optional: Author name to search for.
     * @return string The response from the API, usually JSON or XML data.
     */
    public function searchBooks($series = null, $bookType = null, $author = null)
    {
        // Constructs the query parameters for the API request.
        $query = [
            'series' => $series,
            'book_type' => $bookType,
            'author' => $author,
        ];

        // Sets the required headers for the API request.
        $headers = [
            'x-rapidapi-key' => config('services.rapidApiKey.api_key'), // API key for authentication.
            'x-rapidapi-host' => parse_url($this->baseUri, PHP_URL_HOST), // Hostname extracted from the base URI.
        ];

        // Performs the HTTP GET request using the performRequest method from the ConsumesExternalService trait.
        return $this->performRequest('GET', '/api/search', $query, $headers);
    }
}
