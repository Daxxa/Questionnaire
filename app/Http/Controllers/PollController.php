<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Providers\AuthServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\addPollRequest;
class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ValidatesRequests;
    public function index()
    {
        $polls = Poll::all();

        return view('poll.index',compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poll.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(addPollRequest $request)
    {
        $poll = new Poll();
        $poll->fill($request->all());
        $poll->user_id = Auth::user()->id;
        $poll->save();
        return redirect()->route('polls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poll = Poll::find($id);
        return view('poll.edit',['poll'=>$poll]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(addPollRequest $request, $id)
    {
        $poll = Poll::find($id);
        $poll->fill($request->all());
        $poll->save();
        return redirect()->route('polls.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Poll::find($id)->delete();
        return redirect()->route('polls.index');
    }
}
