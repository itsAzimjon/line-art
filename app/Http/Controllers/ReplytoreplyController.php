<?php

namespace App\Http\Controllers;

use App\Models\Replytoreply;
use Illuminate\Http\Request;

class ReplytoreplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function store(Request $request)
    {
        Replytoreply::create([
            'user_id' => auth()->user()->id,
            'reply_id' => $request->reply_id,
            'comment' => $request->comment,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Replytoreply  $replytoreply
     * @return \Illuminate\Http\Response
     */
    public function show(Replytoreply $replytoreply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Replytoreply  $replytoreply
     * @return \Illuminate\Http\Response
     */
    public function edit(Replytoreply $replytoreply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Replytoreply  $replytoreply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Replytoreply $replytoreply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Replytoreply  $replytoreply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Replytoreply $replytoreply)
    {
        //
    }
}
