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
        return view('search');
    }

    public function SearchProviderResults(Request $request)
    {
        $providers = provider::all();
        return view('searchList', ['providers' => $providers]);
    }

}
