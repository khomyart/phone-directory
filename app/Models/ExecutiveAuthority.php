<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Email;
use App\Models\Number;
use App\Models\SubExecutiveAuthority;
use App\Models\User;

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

    public function emails() {
        return $this->hasMany(Email::class);
    }

    public function numbers() {
        return $this->hasMany(Number::class);
    }

    public function sub_executive_authorities() {
        return $this->hasMany(SubExecutiveAuthority::class);
    }

    public function users() {
        return $this->belongsToMany(User::class,
            'executive_authorities_users',
            'executive_authority_id',
            'user_id');
    }
}
