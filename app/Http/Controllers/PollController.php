<?php

namespace App\Http\Controllers;

use App\Forms\PollForm;
use App\Models\Poll;
use App\Models\Url;
use App\Providers\AuthServiceProvider;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\addPollRequest;
use Kris\LaravelFormBuilder\FormBuilder;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PollForm::class, [
            'method' => 'POST',
            'url' => route('polls.store')
        ]);
        return view('poll.add', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(addPollRequest $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PollForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        } else{
            $poll = new Poll();
            $poll->fill($request->all());
            $poll->user_id = Auth::user()->id;
            $poll->save();
            return redirect()->route('polls.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function link(Poll $poll)
    {
        $code = md5(uniqid(rand(),1));
        $url = new Url();
        $url->url = $code;
        $url->poll_id = $poll->id;
        $url->save();
        return view('poll.link',['link'=>url('/').'/questionnaire/'.$url->url,'poll'=>$poll]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll, FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(PollForm::class, [
            'method' => 'PUT',
            'url' => route('polls.update',['id'=> $poll->id]),
            'title' => $poll->title
        ])->setModel($poll);
        return view('poll.edit',['poll'=>$poll], compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(addPollRequest $request, Poll $poll, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PollForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        } else {

            $poll->fill($request->all());
            $poll->save();
            return redirect()->route('polls.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
       $poll->delete();
        return redirect()->route('polls.index');
    }

}
