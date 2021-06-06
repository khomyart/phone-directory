<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExecutiveAuthority;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'executive_authority_id',
        'is_main'
    ];

    public function executiveAuthority() {
        return $this->belongsTo(ExecutiveAuthority::class);
    }
}
