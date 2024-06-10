<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAController extends Controller
{
    public function index()
    {
        return view('fa.fa-dashboard');
    }
}
