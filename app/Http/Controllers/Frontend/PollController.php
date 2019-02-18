<?php

namespace App\Http\Controllers\Frontend;

use App\Forms\PassPollForm;
use App\Http\Requests\addPassPollRequest;
use App\Models\AnonAnswer;
use App\Models\Answer;
use App\Models\CommentAnswer;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilder;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::all();
        return view('frontend.poll.index',compact('polls'));
    }
    public function show($unique, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PassPollForm::class, [
            'method' => 'POST',
            'url' => route('questionnaire.store'),
        ]);
        $url = Url::where('url',$unique)->first();
        if ($url->count()!=0) {
            $questions =$this->getQuestions($url->poll_id);
            foreach ($questions as $question){
                $answers = Answer::all()->where('question_id',$question->id);
                if(($answers->first()->type == "checkbox")||($answers->first()->type == "radiobutton")){
                    if($answers->first()->type == "checkbox"){
                        $multiple = true;
                        $required = '';
                    }else{
                        $multiple = false;
                        $required = 'required';
                    }
                    $array = array();
                    foreach ($answers as $answer){
                        $array[$answer->id] = $answer->title;
                    }
                    $form->add($question->id, 'choice', [
                        'choices' => $array,
                        'choice_options' => [
                            'wrapper' => ['class' => 'choice-wrapper'],
                            'label_attr' => ['class' => 'label-class'],
                        ],
                        'selected' =>[],
                        'expanded' => true,
                        'multiple' => $multiple,
                        'rules' => $required,
                        'label'=>$question->text,
                        'label_show'=>true,
                        'label_attr' => ['class' => 'poll-qtn-text', 'for' => $question->text],
                        'attr'=>['class'=>'btn-choice']
                    ]);
                }else {
                    $form->add($answers->first()->id, 'textarea',[
                        'rules' => 'required|min:5',
                        'label'=>$question->text,
                        'label_show'=>true,
                        'label_attr' => ['class' => 'poll-qtn-text', 'for' => $question->text],
                    ]);
                }

            }
            $form->add('poll_id','hidden',[
                'value'=>$url->poll_id
            ]);
            $form->add('Send','submit',[
                'attr' => ['class' => 'btn-awr'],
            ]);
        }else {
            dd('error');
        }
        return view('frontend.poll.show', compact('form'));
    }
    private function getQuestions($poll_id)
    {
        $poll = Poll::where('id', $poll_id)->first();
        $questions = Question::all()->where('poll_id', $poll->id);
        return $questions;
    }

    /**
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PassPollForm::class);
        $form->setRequest($request);
       if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        } else{
           $data = $request->except('_token');
           $poll_id = $request->input('poll_id');
           foreach($data as $id => $value){
               if (is_array($value)) {
                   foreach ($value as $one) {
                       $this->addOrUpdate($poll_id,$one);
                   }
               }elseif ($id !='poll_id'){
                   if(Answer::find($value) == null ){
                       $text = $value;
                       $value = $id;
                   }
                   $anonAnswerId = $this->addOrUpdate($poll_id,$value);
                   if($value == $id){
                       $comment = new CommentAnswer();
                       $comment->text = $text;
                       $comment->anon_answer_id = $anonAnswerId;
                       $comment->save();
                   }
               }
           }
            return redirect()->route('polls.index');
        }

    }
    private function addOrUpdate($poll_id,$one)
    {
        $anonAnswer = AnonAnswer::where('poll_id', $poll_id)->where('answer_id', $one)->first();
        if ($anonAnswer == null) {
            $anonAnswer = new AnonAnswer();
            $anonAnswer->poll_id = $poll_id;
            $anonAnswer->answer_id = $one;
            $anonAnswer->count = 1;
            $anonAnswer->save();
        } else {
            $anonAnswer->count = $anonAnswer->count + 1;
            DB::table('anon_answers')->where('id', $anonAnswer->id)->update($anonAnswer->toArray());
        }
        return $anonAnswer->id;
    }
}
