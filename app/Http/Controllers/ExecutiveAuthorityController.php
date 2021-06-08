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
        $lastNumberInListCollection = ExecutiveAuthority::select('number_in_list')->orderByDesc('number_in_list')->limit(1)->get();
        $lastNumberInList = isset($lastNumberInListCollection[0]['number_in_list']) ? $lastNumberInListCollection[0]['number_in_list'] : -1;

        request()->validate([
            'name' => ['required', 'max:50'],
            'identifierCode' => ['required', 'max:50'],
            'locationDescription' => ['required', 'max:100'],
            'coordX' => ['required', 'max:10'],
            'coordY' => ['required', 'max:10']
        ]);

        $optimisedRequestArray = [
            'name' => $request->name,
            'number_in_list' => $lastNumberInList + 1,
            'identifier_code' => $request->identifierCode,
            'location_description' => $request->locationDescription,
            'location_coordinates' => $request->coordX.$request->coordY,
        ];

        ExecutiveAuthority::create($optimisedRequestArray);

        return Redirect::action([self::class, 'index']);
    }

}
