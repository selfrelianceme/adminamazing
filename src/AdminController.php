<?php

namespace Selfreliance\Adminamazing;

use App\Http\Controllers\Controller;
use App\User;
use View;

class AdminController extends Controller
{
    public function index()
    {
        $CountAllUsers = User::count("id");
        return view('adminamazing::home')->with(['CountAllUsers'=>$CountAllUsers]);
    }
}
