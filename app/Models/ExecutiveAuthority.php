<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Email;
use App\Models\PhoneNumber;
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

    /*
     * Relationship methods
     */
    public function emails() {
        return $this->hasMany(Email::class);
    }

    public function numbers() {
        return $this->hasMany(PhoneNumber::class);
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

    /*
     * Additional methods
     */
    public static function getLastValueOfNumberInList() {
        $lastNumberInListCollection = static::select('number_in_list')->orderByDesc('number_in_list')->limit(1)->get();
        $lastNumberInList = isset($lastNumberInListCollection[0]['number_in_list']) ? $lastNumberInListCollection[0]['number_in_list'] : -1;
        return $lastNumberInList;
    }

    public function addRelatedNumbers(array $numbers) {
        foreach ($numbers as $number)
            PhoneNumber::create([

                'executive_authority_id' => $this->id,
            ]);
        return $this;
    }
}
