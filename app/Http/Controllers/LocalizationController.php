<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
	/**
	 * Gestion localizations
	 */
    public function index($locale)
	{
		App::setLocale($locale);
		session()->put('locale', $locale);
		return redirect()->back();
	}
}
