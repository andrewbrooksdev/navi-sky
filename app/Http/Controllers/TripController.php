<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Trip;
use App\Traits\HttpResponses;

class TripController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return TripsResource::collection(
            Trip::where('user_id', Auth::user()->id)->get()
        );
    }

    public function store(StoreTripRequest $request)
    {
        $request->validated($request->all());

        $trip = Trip::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
        ]);

        return new TripsResource($trip);
    }

    public function show(Trip $trip)
    {
        if(Auth::user()->id !== $trip->user_id){
            return $this->error('', 'Not authorized.', 403);
        }

        return new TripsResource($trip);
    }


    public function update(Request $request, Trip $trip)
    {
        if(Auth::user()->id !== $trip->user_id){
            return $this->error('', 'Not authorized.', 403);
        }

        $trip->update($request->all());

        return new TripsResource($trip);
    }


    public function destroy(Trip $trip)
    {
        if(Auth::user()->id !== $trip->user_id){
            return $this->error('', 'Not authorized.', 403);
        }

        $trip->delete();

        return response(null, 204);
    }
}
