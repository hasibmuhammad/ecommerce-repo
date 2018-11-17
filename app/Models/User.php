<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model {
    protected $guarded = [];
    public $timestamps = false; // created_at and updated_at column won't be searched anymore if it is in false mood
}