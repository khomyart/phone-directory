<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubExecutiveAuthority;
use App\Models\Number;

class Worker extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sub_executive_authority() {
        return $this->belongsTo(SubExecutiveAuthority::class);
    }

    public function numbers() {
        return $this->hasMany(Number::class);
    }
}
