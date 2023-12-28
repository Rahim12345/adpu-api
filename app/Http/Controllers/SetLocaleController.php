<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    public function setLocale($lang)
    {
        if (in_array($lang,['az','en']))
        {
            session()->put('locale', $lang);
        }
        else
        {
            session()->put('locale', 'az');
        }

        return redirect()->back();
    }
}
