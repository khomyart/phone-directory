<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\ExecutiveAuthority;

class ExecutiveAuthorityController extends Controller
{

    public function index() {
        return Inertia::render('Control', [
            'executiveAuthorities' => ExecutiveAuthority::all(),
            'auth' => Auth::user()
        ]);
    }

    public function store(Request $request) {

        request()->validate([
            'name' => ['required', 'max:100'],
            'identifierCode' => ['required', 'max:50'],
            'locationDescription' => ['required', 'max:200'],
            'coordX' => ['required', 'max:10'],
            'coordY' => ['required', 'max:10']
        ]);

        $optimisedRequestArray = [
            'name' => $request->name,
            'number_in_list' => ExecutiveAuthority::getLastValueOfNumberInList() + 1,
            'identifier_code' => $request->identifierCode,
            'location_description' => $request->locationDescription,
            'location_coordinates' => $request->coordX.$request->coordY,
        ];

        $executiveAuthority = ExecutiveAuthority::create($optimisedRequestArray);
        return Redirect::action([self::class, 'index']);
    }

}
