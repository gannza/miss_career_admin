<?php

namespace App\Http\Controllers;
class HomeController extends AppBaseController
{

    public function __construct()
    {
       
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('home');
    }

   
}
