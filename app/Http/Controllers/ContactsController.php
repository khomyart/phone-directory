<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ContactsController extends Controller
{
    public function index() {
        return inertia('Contacts', [
            'users' => User::all(),
        ]);
    }
}
