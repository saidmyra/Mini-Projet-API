<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('weather');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::get('https://api.weatherapi.com/v1/current.json', [
            'key' => "9752350d74544544b7064604261604",
            'q'   => $request->input('ccity'),
        ]);

        if ($response->failed()) {
            $error = 'City not found. Please check the name and try again.';
            return view('weather', compact('error'));
        }

        $data = $response->json();

        $city        = $data['location']['name'];
        $country       = $data['location']['country'];
        $temperature = $data['current']['temp_c'];
        $windkmh     = $data['current']['wind_kph'];
        $condition   = $data['current']['condition']['text'];

        return view('weather', compact('city', 'temperature', 'windkmh', 'condition', 'country'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
