<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'students'; // Optional: specify the table name

    protected $fillable = [
        'name',
        'subject_name',
        'marks',
    ];

    // Optional: Define any relationships or additional methods here
}
