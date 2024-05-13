<?php
namespace App\Http\Controllers\Principal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class PrincipalController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        return view('principal.home');
    }

}
