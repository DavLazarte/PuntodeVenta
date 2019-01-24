<?php

namespace zitaraventas\Http\Controllers;

use zitaraventas\Http\Requests;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }
}
