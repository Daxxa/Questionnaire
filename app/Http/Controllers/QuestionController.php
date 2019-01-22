<?php

namespace App\Http\Controllers;

use App\Http\Requests\addQuestionRequest;
use App\Models\Poll;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($poll_id)
    {
        $poll = Poll::all()->find($poll_id);
        $questions=Question::all()->where('poll_id',$poll_id);
        return view('question.index',['questions'=>$questions, 'poll'=>$poll]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($poll_id)
    {
        $poll = Poll::all()->find($poll_id);
        return view('question.add',['poll'=>$poll]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(addQuestionRequest $request)
    {
        $question = new Question();
        $question->fill($request->all());
        $question->save();
        return redirect()->route('questions.index',$question->poll_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(addQuestionRequest $request, $id)
    {

        $question = Question::find($id);
        $poll_id = $question->poll_id;
        $question->fill($request->all());

        $question->save();
        return redirect()->route('questions.index',$poll_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poll_id = Question::find($id)->poll_id;
        Question::find($id)->delete();
        return redirect()->route('questions.index',$poll_id);
    }
}
