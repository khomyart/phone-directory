<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Worker;
use App\Models\PhoneNumber;
use App\Models\ExecutiveAuthority;

class SubExecutiveAuthority extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function workers() {
        return $this->hasMany(Worker::class);
    }

    public function numbers() {
        return $this->hasMany(PhoneNumber::class);
    }

    public function executive_authority() {
        return $this->belongsTo(ExecutiveAuthority::class);
    }
}
