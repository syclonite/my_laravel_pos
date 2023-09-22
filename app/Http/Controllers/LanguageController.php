<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
//        dd($request->all());
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
//        echo __('message.title');
        return redirect()->back();
    }
}
