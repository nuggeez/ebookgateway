<?php

// Defines the namespace for this configuration file.
return [
    // Configuration for RapidAPI Key
    'rapidApiKey' => [
        'api_key' => env('RAPIDAPI_KEY'),
    ],

    // Configuration for BookFinder Service
    'bookFinder' => [
        'base_uri' => env('BOOKFINDER_SERVICE_BASE_URL')
    ],

    // Configuration for AllBooksApi Service
    'allBooksApi' => [
        'base_uri' => env('ALLBOOKSAPI_SERVICE_BASE_URL'),
    ],

    // Configuration for MyAnimeList Service
    'myAnimeList' => [
        'base_uri' => env('MYANIMELIST_SERVICE_BASE_URL'),
    ],
];
