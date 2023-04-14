<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationonController extends Controller
{
final public function setlan($locale)
{
    App::setLocale($locale);
    Session::put("locale",$locale);
    return redirect()->back();
}
}
