<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\provider;

class SearchProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function SearchProvider(Request $request)
    {
        if ($request->query('company-name'))
        {
            $providers = provider::all();
            return view('searchList', ['providers' => $providers]);
        }
        return view('search');
    }

}
