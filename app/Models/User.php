<?php

// Defines the namespace for this model. It helps in organizing and grouping classes logically within the application.
namespace App\Models;

// Imports the base Model class from the Illuminate\Database\Eloquent namespace. This class provides the core functionalities for Eloquent models.
use Illuminate\Database\Eloquent\Model;

// Declares the User class, which extends Laravel's base Model class.
class User extends Model 
{
    // Specifies the database table associated with this model.
    protected $table = 'users';

    // Defines the attributes that are mass assignable. This helps to prevent mass-assignment vulnerabilities.
    protected $fillable = [
        'user_id', 'name', 'email', 'password', 'created_at', 'updated_at'
    ];

    // Specifies the primary key for the table. By default, Eloquent assumes the primary key is named 'id'. Here, it is explicitly set to 'user_id'.
    protected $primaryKey = 'user_id';
}
