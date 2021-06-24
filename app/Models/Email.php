<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExecutiveAuthority;

class Email extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function executiveAuthority() {
        return $this->belongsTo(ExecutiveAuthority::class);
    }


    public static function getLastValueOfNumberInList($id) {
        $lastNumberInListCollection = static::select('number_in_list')
            ->where('executive_authority_id',$id)
            ->orderByDesc('number_in_list')
            ->limit(1)
            ->get();
        return isset($lastNumberInListCollection[0]['number_in_list']) ? $lastNumberInListCollection[0]['number_in_list'] : 0;
    }
}
