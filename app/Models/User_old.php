<?php

// Defines the namespace for this model. It helps in organizing and grouping classes logically within the application.
namespace App\Models;

// Imports necessary traits and contracts from Laravel and Lumen frameworks.
use Illuminate\Auth\Authenticatable; // Trait for implementing the methods required by the Authenticatable contract.
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract; // Contract for defining authorization capabilities.
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract; // Contract for defining authentication capabilities.
use Illuminate\Database\Eloquent\Factories\HasFactory; // Trait for using model factories.
use Illuminate\Database\Eloquent\Model; // Base Eloquent model class.
use Laravel\Lumen\Auth\Authorizable; // Trait for implementing the methods required by the Authorizable contract.

// Declares the User_old class, which extends Laravel's base Model class and implements the AuthenticatableContract and AuthorizableContract.
class User_old extends Model implements AuthenticatableContract, AuthorizableContract
{
    // Uses the Authenticatable, Authorizable, and HasFactory traits within this model, providing their respective functionalities.
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', // Allows mass assignment on the 'name' and 'email' attributes.
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password', // Excludes the 'password' attribute from the model's JSON representation.
    ];
}
