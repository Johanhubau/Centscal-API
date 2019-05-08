<?php

namespace App\Http\Controllers\Api;

use App\Association;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'color' => 'required|size:7|starts_with:#',
            'user_id' => 'required|exists:users,id'
        ]);

        $user = Auth::user();
        if(!$user->is_admin){
            return response()->json(['error' => 'User not admin', 403]);
        }

        Association::create($validated);
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
        $validated = $request->validate([
            'name' => 'min:2|max:255',
            'color' => 'size:7|starts_with:#'
        ]);

        $association->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Association $association
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Association $association)
    {
        $association->delete();
    }
}
