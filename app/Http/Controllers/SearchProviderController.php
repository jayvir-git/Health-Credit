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

        $providers = provider::query();
        if ($request->filled('name')) {
            $providers = $providers->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('specialty')) {
            $providers = $providers->whereIn('specialty', $request->input('specialty'));
        }

        if ($request->filled('zipcode')) {
            $providers = $providers->where('zipcode', $request->input('zipcode'));
        }

        if ($request->json('specialty')) {
            $providers = $providers->whereIn('specialty', $request->json('specialty'));
        }

        $providers = $providers->get()->all();

        return view('searchList', ['providers' => $providers]);
    }
}
