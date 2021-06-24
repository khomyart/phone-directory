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
        return isset($lastNumberInListCollection[0]['number_in_list']) ? $lastNumberInListCollection[0]['number_in_list'] : -1;
    }

    public function addRelatedPhoneNumbers(array $phoneNumbers) {
        $amountOfPhoneNumbers = PhoneNumber::getLastValueOfNumberInList($this->id, 'executive_authority_id');

        foreach ($phoneNumbers as $phoneNumber) {
            PhoneNumber::create([
                'number_in_list' => $amountOfPhoneNumbers,
                'number' => $phoneNumber['input'],
                'number_type' => $phoneNumber['selection'],
                'executive_authority_id' => $this->id,
            ]);
            $amountOfPhoneNumbers++;
        }
    }

    public function addRelatedEmails(array $emails) {
        $amountOfEmails = Email::getLastValueOfNumberInList($this->id);

        foreach ($emails as $email) {
            Email::create([
                'email' => $email['input'],
                'number_in_list' => $amountOfEmails,
                'is_main' => $email['checkbox'] === true ? 'yes' : 'no',
                'executive_authority_id' => $this->id,
            ]);
            $amountOfEmails++;
        }
    }

    public function addInitSubExecutiveAuthority() {
        SubExecutiveAuthority::create([
            'executive_authority_id' => $this->id,
            'number_in_list' => 0,
            'name' => $this->name,
            'type' => 'main',
        ]);
    }
}
