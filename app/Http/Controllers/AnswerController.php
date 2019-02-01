<?php

namespace App\Http\Controllers;

use App\Forms\AnswerForm;
use App\Http\Requests\addAnswerRequest;
use App\Models\Answer;
use App\Models\Poll;
use App\Models\Question;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Poll $poll
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function index(Poll $poll, Question $question, FormBuilder $formBuilder)
    {
        $answers=Answer::all()->where('question_id',$question->id);
        $formAdd = $formBuilder->create(AnswerForm::class, [
            'method' => 'POST',
            'url' => route('answers.store',[$poll,$question]),
        ]);
        $oneanswer = new Answer();
        $oneanswer->title='';
        $oneanswer->type='';

        $this->addMany($formAdd,$question, $answers, $oneanswer);
        $forms = array();
        foreach ($answers as $answer)
        {
            $form = $formBuilder->create(AnswerForm::class, [
                'method' => 'PUT',
                'url' => route('answers.update',[$poll,$question,$answer]),
            ]);
            $form->setModel($answer);
            $this->addMany($form,$question, $answers, $answer);
            array_push($forms,$form);
        }


        return view('answer.index',['answers'=>$answers, 'poll'=>$poll, 'question'=>$question,'formAdd'=>$formAdd, 'forms'=>$forms]);
    }

    public function addMany($form, $question, $answers, $oneanswer)
    {
        $form->addBefore('question_id','question_id','hidden',[
            'value'=>$question->id
        ]);
        $type = ' ';
        foreach ($answers as $answer){
            if ($answer->type!='input'){
                $type = $answer->type;
            }
        }
        if($type != ' '){
            if($type == 'checkbox') $name = 'Checkbox';
            if($type == 'radiobutton') $name = 'Radiobutton';
            $form->addBefore('type','type', 'select', [
                'choices' => [$type => $name,],
                'selected' => $oneanswer->type,
                'empty_value' => '=== Select type ==='
            ]);
        }else
            $form->addBefore('type','type', 'select', [
                'choices' => ['checkbox' => 'Checkbox', 'radiobutton' => 'Radiobutton','input'=>'Input' ],
                'selected' => $oneanswer->type,
                'empty_value' => '=== Select type ==='
            ]);
        $form->addBefore('title','title','text',[
            'value'=>$oneanswer->title
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Poll $poll,Question $question,FormBuilder $formBuilder)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Poll $poll,Question $question,addAnswerRequest $request)
    {
        $answer = new Answer();
        $answer->fill($request->all());
        $answer->save();
        return redirect()->route('answers.index',[$poll,$question]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Poll $poll, Question $question, Answer $answer)
    {
        $answer->fill($request->all());
        $answer->save();
        return redirect()->route('answers.index',[$poll,$question]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll, Question $question, Answer $answer)
    {
        $answer->delete();
        return redirect()->route('answers.index',[$poll,$question]);
    }
}
