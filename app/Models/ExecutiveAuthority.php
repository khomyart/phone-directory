<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExecutiveAuthority extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_in_list',
        'name',
        'identifier_code',
        'location_description',
        'location_coordinates'
    ];
}
