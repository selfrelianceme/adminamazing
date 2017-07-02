<?php

namespace Selfreliance\Adminamazing;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function index()
    {
        // echo "Welcome to admin";
        return view('adminamazing::home');
    }

}
