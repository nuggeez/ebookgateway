<?php

// Defines the namespace for this service. It helps in organizing and grouping classes logically within the application.
namespace App\Services;

// Imports the ConsumesExternalService trait, which likely contains methods for interacting with external APIs.
use App\Traits\ConsumesExternalService;

// Declares the MyAnimeListService class.
class MyAnimeListService
{
    use ConsumesExternalService; // Uses the ConsumesExternalService trait within this service, giving access to its methods.

    /**
     * The base URI to consume the MyAnimeList service.
     *
     * @var string
     */
    public $baseUri;

    /**
     * Create a new instance of MyAnimeListService.
     *
     * @return void
     */
    public function __construct()
    {
        // Sets the base URI for the MyAnimeList service by retrieving it from the configuration.
        $this->baseUri = config('services.myAnimeList.base_uri');
    }

    /**
     * Get manga recommendations from MyAnimeList API.
     *
     * @param int $page Optional: Page number for pagination (default is 1).
     * @return string The response from the API, usually JSON or XML data.
     */
    public function getMangaRecommendations($page = 1)
    {
        // Defines the API endpoint for fetching manga recommendations.
        $endpoint = "/v2/manga/recommendations";

        // Constructs the query parameters for the API request.
        $query = [
            'p' => $page,
        ];

        // Sets the required headers for the API request.
        $headers = [
            'x-rapidapi-key' => config('services.rapidApiKey.api_key'), // API key for authentication.
            'x-rapidapi-host' => parse_url($this->baseUri, PHP_URL_HOST), // Hostname extracted from the base URI.
        ];

        // Performs the HTTP GET request using the performRequest method from the ConsumesExternalService trait.
        return $this->performRequest('GET', $endpoint, $query, $headers);
    }

    /**
     * Get manga details from MyAnimeList API by ID.
     *
     * @param int $mangaId The ID of the manga to fetch details for.
     * @return string The response from the API, usually JSON or XML data.
     */
    public function getMangaDetailsById($mangaId)
    {
        // Defines the API endpoint for fetching manga details by ID.
        $endpoint = "/manga/{$mangaId}";

        // Sets the required headers for the API request.
        $headers = [
            'x-rapidapi-key' => config('services.rapidApiKey.api_key'), // API key for authentication.
            'x-rapidapi-host' => parse_url($this->baseUri, PHP_URL_HOST), // Hostname extracted from the base URI.
        ];

        // Performs the HTTP GET request using the performRequest method from the ConsumesExternalService trait.
        return $this->performRequest('GET', $endpoint, [], $headers);
    }
}
