<?php

namespace Selfreliance\Adminamazing;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use File;
use App\User;
class AdminController extends Controller
{

	public $vendor = "selfreliance";
	public $library = "adminamazing";

    public function index()
    {

    	$contents = File::get(__DIR__.'/../../../../composer.json');
    	$pks = json_decode($contents);
    	foreach($pks->require as $name=>$ver){
    		$a = explode("/", $name);
    		if($a[0] == $this->vendor && $a[1] != $this->library){
    			// echo $a[1];
    		}
    	}
        $CountAllUsers = User::count("id");

        return view('adminamazing::home')->with(['CountAllUsers'=>$CountAllUsers]);
    }

}
