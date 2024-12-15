<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegistrationResource;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class RegistrationController extends Controller
{
    function index(Request $request):JsonResource{
        $registrations = Registration::all();

        $orderBy = $request->query("orderBy");
        $order = $request->query("order");

        if (!($orderBy=="name"||$orderBy=="date")||!($order=="asc"||$order=="desc")||($order==null||$orderBy==null)) {
            abort(404);
        }
        
        if ($orderBy=="name") {
            if ($order=="desc") {
                $registrations = $registrations->sortByDesc("name");
            }
            else{
                $registrations = $registrations->sortBy("name");
            }
        }
        elseif ($orderBy=="date") {
            if ($order=="desc") {
                $registrations = $registrations->sortByDesc("date");
            }
            else{
                $registrations = $registrations->sortBy("date");
            }
        }

        return RegistrationResource::collection($registrations);
    }

    function show(int $id):JsonResource{
        $registration = Registration::findOrFail($id);
        return new RegistrationResource($registration);
    }

    function destroy(int $id):Response{
        return (Registration::findOrFail($id)->delete())
        ?response()->noContent()
        :abort(500);
    }
    function count(){
        $registrationsC = Registration::whereNotNull("arrived")->count();
        return $registrationsC;
    }
}
