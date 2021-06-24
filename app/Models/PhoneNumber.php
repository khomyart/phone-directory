<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Worker;
use App\Models\ExecutiveAuthority;
use App\Models\SubExecutiveAuthority;

class PhoneNumber extends Model
{
    use HasFactory;

    /* If guarded array is empty, that means what every column in table is fillable */
    protected $guarded = [];

    /* Relationship methods */

    public function worker() {
        return $this->belongsTo(Worker::class);
    }

    public function executive_authority() {
        return $this->belongsTo(ExecutiveAuthority::class);
    }

    public function sub_executive_authority() {
        return $this->belongsTo(SubExecutiveAuthority::class);
    }

    /* Additional methods */

    /**
     *
     * Returns last value of column "number_in_list" depends on table, witch is incoming parameter
     * Explanation (example): first executive authority has 5 phone numbers, second e.a. has 3, so depends on ID of
     * particular executive authority, we have different last values for number_in_list column of phone_numbers table.
     * Also, we need to consider possibility of connection phone_numbers with tables like workers, sub_executive_authorities, etc
     *
     * @param int $id
     * @param string $relationColumnName
     * @return int
     */
    public static function getLastValueOfNumberInList($id, $relationColumnName) {
        $lastNumberInListCollection = static::select('number_in_list')
            ->orderByDesc('number_in_list')
            ->where($relationColumnName, $id)
            ->limit(1)
            ->get();
        return isset($lastNumberInListCollection[0]['number_in_list']) ? $lastNumberInListCollection[0]['number_in_list'] : 0;
    }
}
