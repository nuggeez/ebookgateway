<?php

// Defines the namespace for this model. It helps in organizing and grouping classes logically within the application.
namespace App\Models;

// Imports the base Model class from the Illuminate\Database\Eloquent namespace. This class provides the core functionalities for Eloquent models.
use Illuminate\Database\Eloquent\Model;

// Declares the AuthenticationLog class, which extends Laravel's base Model class.
class AuthenticationLog extends Model 
{
    // Specifies the database table associated with this model.
    protected $table = 'authentication_log';

    // Defines the attributes that are mass assignable. This helps to prevent mass-assignment vulnerabilities.
    protected $fillable = [
        'log_id', 'auth_id', 'login_timestamp'
    ];

    // Specifies the primary key for the table. By default, Eloquent assumes the primary key is named 'id'. Here, it is explicitly set to 'log_id'.
    protected $primaryKey = 'log_id';

    // Indicates if the model should be timestamped. When set to false, Eloquent will not expect created_at and updated_at columns to exist on the table.
    public $timestamps = false;
}
