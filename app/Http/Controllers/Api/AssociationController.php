<?php

namespace App\Http\Controllers\Api;

use App\Association;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Association[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Association::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Association $association
     * @return Association
     */
    public function show(Association $association)
    {
        return $association;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Association  $association
     * @return \Illuminate\Http\Response
     */
    public function edit(Association $association)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Association  $association
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Association $association)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Association  $association
     * @return \Illuminate\Http\Response
     */
    public function destroy(Association $association)
    {
        //
    }
}
