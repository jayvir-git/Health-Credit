<?php

namespace App\Http\Controllers;

use App\Models\application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('apply');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $msg = 'inside the store';
        var_dump($msg);
        $validated = $request->validate([
            'last_4_ssn' => 'required|string|min:4|max:4',
            'mobile_number' => 'required|string|min:10|max:10',
            'user_id' => 'required|string',
            'provider_id' => 'required|string',
        ]);
        var_dump($validated);
        application::create(array_merge(['status' => 'pending'], $validated));
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(application $application)
    {
        //
    }
}
