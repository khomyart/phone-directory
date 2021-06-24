<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExecutiveAuthorityPhoneNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $matches = [];
        preg_match('/^\+[0-9]{12}$/', $value, $matches);

        if (count($matches) != 0) {
            return true;
        } return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Номер повинен починатись зі знаку "+" та мати довжину 13 цифр';
    }
}
