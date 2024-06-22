<?php

// Defines the namespace for this service provider. It helps in organizing and grouping classes logically within the application.
namespace App\Providers;

// Imports necessary classes from Laravel and Lumen frameworks.
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider; // Base event service provider class.

// Declares the EventServiceProvider class, which extends Laravel Lumen's base EventServiceProvider class.
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [ // Maps ExampleEvent to its listener.
            \App\Listeners\ExampleListener::class, // Registers ExampleListener to handle ExampleEvent.
        ],
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false; // Disables automatic event discovery.
    }
}
