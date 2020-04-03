<?php

namespace App\Http\Controllers\Personeladmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersoneladminPageAdd extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('pages.PersonelAdminPageAdd');
    }
}
