<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Worker;
use App\Models\ExecutiveAuthority;
use App\Models\SubExecutiveAuthority;

class Number extends Model
{
    use HasFactory;

    /*
     * If guarded array is empty, that means what every column in table is fillable
     */
    protected $guarded = [];

    public function worker() {
        return $this->belongsTo(Worker::class);
    }

    public function executive_authority() {
        return $this->belongsTo(ExecutiveAuthority::class);
    }

    public function sub_executive_authority() {
        return $this->belongsTo(SubExecutiveAuthority::class);
    }

}
