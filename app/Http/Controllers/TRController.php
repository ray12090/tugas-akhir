<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TRController extends Controller
{
    public function index()
    {
        return view('tr.tr-dashboard');
    }
}
