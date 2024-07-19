<?php

namespace App\Http\Controllers;

use App\Models\approvalRequestPemilik;
use Illuminate\Http\Request;

class ApprovalRequestPemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('approval_request_pemilik.approval_request_pemilik');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(approvalRequestPemilik $approvalRequestPemilik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(approvalRequestPemilik $approvalRequestPemilik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, approvalRequestPemilik $approvalRequestPemilik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(approvalRequestPemilik $approvalRequestPemilik)
    {
        //
    }
}
