<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWaypointRequest;
use App\Http\Resources\WaypointsResource;
use App\Models\Waypoint;
use App\Traits\HttpResponses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class WaypointController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return WaypointsResource::collection(
            Waypoint::whereHas('trip', function (Builder $query) {
                $query->where('user_id', Auth::user()->id);
            })->get()
        );
    }

    public function store(StoreWaypointRequest $request)
    {
        $request->validated($request->all());
        $waypoint = Waypoint::create([
            'trip_id' => $request->trip_id,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'depart_at' => $request->depart_at,
        ]);

        return new WaypointsResource($waypoint);
    }

    public function destroy(Waypoint $waypoint)
    {
        if (Auth::user()->id !== $waypoint->trip->user_id) {
            return $this->error([], 403, 'Not authorized.');
        }

        $waypoint->delete();

        return response(null, 204);
    }
}
