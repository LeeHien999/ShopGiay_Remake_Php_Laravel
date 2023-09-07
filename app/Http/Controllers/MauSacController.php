<?php

namespace App\Http\Controllers;

use App\Models\MauSac;
use Illuminate\Http\Request;

class MauSacController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.page.color.index');
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
    public function show(MauSac $mauSac)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MauSac $mauSac)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MauSac $mauSac)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MauSac $mauSac)
    {
        //
    }
}
