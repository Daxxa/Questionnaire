<?php

namespace App\Http\Controllers;

use App\Forms\QuestionForm;
use App\Http\Requests\addQuestionRequest;
use App\Models\Poll;
use App\Models\Question;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Poll $poll
     * @return \Illuminate\Http\Response
     */
    public function index(Poll $poll)
    {
        $questions=Question::all()->where('poll_id',$poll->id);
        return view('question.index',['questions'=>$questions, 'poll'=>$poll]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Poll $poll,FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(QuestionForm::class, [
            'method' => 'POST',
            'url' => route('questions.store',$poll),
        ]);
        $form->add('poll_id','hidden',[
            'value'=>$poll->id
        ]);
        return view('question.add',compact('form'));
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
    public function update(addQuestionRequest $request,Poll $poll, Question $question)
    {
        $question->fill($request->all());
        $question->save();
        return redirect()->route('questions.index',$poll);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @param Poll $poll
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Poll $poll, Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index',$poll);
    }
}
