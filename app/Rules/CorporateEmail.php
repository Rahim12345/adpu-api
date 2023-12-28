<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class CorporateEmail implements Rule
{
    public function passes($attribute, $value)
    {
        // Add your corporate email domains here
        $corporateDomains = ['mailinator.com','rahim.com', 'farid.com'];

        $domain = explode('@', $value)[1];

        return in_array($domain, $corporateDomains);
    }

    public function message()
    {
        return app()->getLocale() == 'az' ? ':attribute doğru korporativ formatda deyil' : 'The :attribute must be a valid corporate email address.';
    }
}
