<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use Illuminate\Support\Facades\Redirect;
use App\Models\ExecutiveAuthority;

/**
 * Rules
 */
use App\Rules\RequiredField;
use App\Rules\ExecutiveAuthorityName;
use App\Rules\ExecutiveAuthorityIdentifierCode;
use App\Rules\ExecutiveAuthorityLocationDescription;
use App\Rules\ExecutiveAuthorityLocationCoordinates;
use App\Rules\ExecutiveAuthorityPhoneNumber;
use App\Rules\ExecutiveAuthorityEmail;


class ExecutiveAuthorityController extends Controller
{

    public function index() {
        return Inertia::render('Control', [
            'executiveAuthorities' => ExecutiveAuthority::all(),
            'auth' => Auth::user()
        ]);
    }

    public function store(Request $request) {
        //TODO: do something with empty email and phone fields
        request()->validate([
            'name' => [new RequiredField, new ExecutiveAuthorityName],
            'identifierCode' => [new ExecutiveAuthorityIdentifierCode],
            'locationDescription' => [new RequiredField, new ExecutiveAuthorityLocationDescription],
            'coordinates' => [new ExecutiveAuthorityLocationCoordinates],
            'phoneNumbers.*.input' => [new RequiredField, new ExecutiveAuthorityPhoneNumber],
            'emails.*.input' => [new RequiredField, new ExecutiveAuthorityEmail],
        ]);

        $optimisedRequestArray = [
            'name' => $request->name,
            'number_in_list' => ExecutiveAuthority::getLastValueOfNumberInList() + 1,
            'identifier_code' => $request->identifierCode,
            'location_description' => $request->locationDescription,
            'location_coordinates' => $request->coordinates,
        ];

        $executiveAuthority = ExecutiveAuthority::create($optimisedRequestArray);
        $executiveAuthority->addRelatedPhoneNumbers($request->all()['phoneNumbers']);
        $executiveAuthority->addRelatedEmails($request->all()['emails']);
        $executiveAuthority->addInitSubExecutiveAuthority();

        return Redirect::action([self::class, 'index']);
    }

}
