<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
class HomeController extends Controller
{
    function __construct(){
        View::share('menu_active', url('dashboard'));
    }
    public function index(Request $request)
    {
        return view('dashboard');
    }
}
