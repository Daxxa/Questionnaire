<?php

namespace App\Http\Controllers;

use App\Forms\PassPollForm;
use App\Forms\PollForm;
use App\Models\AnonAnswer;
use App\Models\Answer;
use App\Models\CommentAnswer;
use App\Models\IncludedPolls;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Url;
use App\Providers\AuthServiceProvider;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\addPollRequest;
use Kris\LaravelFormBuilder\FormBuilder;

class PollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Poll[]|\Illuminate\Database\Eloquent\Collection
     */
    public function UsersPolls(){
        $polls = Poll::all()->where('user_id',Auth::id());
        return $polls;
    }

    public function index()
    {

        $polls = Poll::all()->where('user_id',Auth::id());
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

    public function show(Poll $poll,FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PassPollForm::class, [
        ]);
        $questions =Question::all()->where('poll_id',$poll->id);
        $form = $this->show_results($questions,$form,$poll);
        $array = array();

        for ($i =0;$i<$questions->count();$i++){

        }
        $included_form = $formBuilder->create(PassPollForm::class, [
        ]);
        $included_polls = IncludedPolls::all()->where('poll_id',$poll->id);
        $included_questions =new Collection();
        foreach ($included_polls as $one)
            $included_questions =$included_questions->merge(Question::all()->where('poll_id',$one->included_poll_id));

        $included_form = $this->show_results($included_questions,$included_form,$poll);


        /*if ($questions->count()!=0)
        foreach ($questions as $question){
            $form->add(uniqid(), 'static', [
                'tag' => 'div', // Tag to be used for holding static data,
                'attr' => ['class' => 'count-title'], // This is the default
                'value' => 'Count',
                'class' => 'count-title',
                'label_show'=>false// If nothing is passed, data is pulled from model if any
            ]);
            $form->add($question->id, 'static', [
                'tag' => 'div', // Tag to be used for holding static data,
                'attr' => ['class' => 'poll-qtn-text padding-20'], // This is the default
                'value' => $question->text,

                'label_show'=>false// If nothing is passed, data is pulled from model if any
            ]);
            $answers = Answer::all()->where('question_id',$question->id);
            if ($answers->count() !=0)
            if($answers->first()->type == "checkbox"){
                foreach ($answers as $answer){
                    $form->add($answer->title, 'checkbox', [
                        'value' => 1,
                        'checked' => true,
                        'label_attr' => ['class' => 'label-class'],
                        'wrapper' => ['class' => 'inline-block'],
                    ]);
                    $anonAnswer = AnonAnswer::all()->where('poll_id',$poll->id)->where('answer_id',$answer->id)->first();
                    $count=0;
                    if ($anonAnswer !=null) $count =$anonAnswer->count;
                    $form->add(uniqid(), 'static', [
                        'tag' => 'div', // Tag to be used for holding static data,
                        'attr' => ['class' => 'poll-awr-count'], // This is the default
                        'value' => $count,
                        'class' => 'poll-awr-count',
                        'label_show'=>false// If nothing is passed, data is pulled from model if any
                    ]);
                };
            } elseif ($answers->first()->type == "radiobutton"){
                foreach ($answers as $answer){
                    $form->add($answer->title, 'radio', [
                        'value' => 1,
                        'checked' => true,
                        'label_attr' => ['class' => 'label-class'],
                        'wrapper' => ['class' => 'inline-block'],
                    ]);
                    $anonAnswer = AnonAnswer::all()->where('poll_id',$poll->id)->where('answer_id',$answer->id)->first();
                    $count=0;
                    if ($anonAnswer !=null) $count =$anonAnswer->count;
                    $form->add(uniqid(), 'static', [
                        'tag' => 'div', // Tag to be used for holding static data,
                        'attr' => ['class' => 'poll-awr-count'], // This is the default
                        'value' => $count,
                        'class' => 'poll-awr-count',
                        'label_show'=>false// If nothing is passed, data is pulled from model if any
                    ]);

                };
            }else{
                foreach ($answers as $answer) {
                    $anonAnswer = AnonAnswer::all()->where('poll_id', $poll->id)->where('answer_id', $answer->id)->first();
                    $count = 0;
                    if ($anonAnswer != null) $count = $anonAnswer->count;
                    $form->add(uniqid(), 'static', [
                        'tag' => 'div', // Tag to be used for holding static data,
                        'attr' => ['class' => 'poll-awr-count-input'], // This is the default
                        'value' => $count,
                        'class' => 'poll-awr-count-input',
                        'label_show' => false// If nothing is passed, data is pulled from model if any
                    ]);
                    $commentAnswers = null;
                    if ($anonAnswer != null) $commentAnswers = CommentAnswer::all()->where('anon_answer_id', $anonAnswer->id);
                    if ($commentAnswers != null) {
                        foreach ($commentAnswers as $commentAnswer) {
                            $form->add(uniqid(), 'textarea', [
                                'label_show' => false,
                                'value' => $commentAnswer->text,
                                'attr' => ['readonly', 'rows' => '3'],
                            ]);
                        }
                    }
                }
            }
        }*/
        return view('poll.show', ['form'=>$form,'included_form'=>$included_form,'poll'=>$poll]);
    }
    public function show_results(Collection $questions, PassPollForm $form, Poll $poll){

        if ($questions->count()!=0)
            foreach ($questions as $question){
                $form->add(uniqid(), 'static', [
                    'tag' => 'div', // Tag to be used for holding static data,
                    'attr' => ['class' => 'count-title'], // This is the default
                    'value' => 'Count',
                    'class' => 'count-title',
                    'label_show'=>false// If nothing is passed, data is pulled from model if any
                ]);

                $form->add($question->id, 'static', [
                    'tag' => 'div', // Tag to be used for holding static data,
                    'attr' => ['class' => 'poll-qtn-text padding-20'], // This is the default
                    'value' => $question->text,

                    'label_show'=>false// If nothing is passed, data is pulled from model if any
                ]);
                $form->add('chart-'.$question->id, 'static', [
                    'tag' => 'div', // Tag to be used for holding static data,
                    'attr' => ['class' => 'btn chart-btn','id'=>'chart-'.$question->id], // This is the default
                    'text' => $question->text,
                    'value'=>'Chart',

                    'label_show'=>false// If nothing is passed, data is pulled from model if any
                ]);
                $answers = Answer::all()->where('question_id',$question->id);
                if ($answers->count() !=0)
                    if($answers->first()->type == "checkbox"){
                        foreach ($answers as $answer){
                            $form->add($answer->title, 'checkbox', [
                                'value' => 1,
                                'checked' => true,
                                'label_attr' => ['class' => 'label-class'],
                                'wrapper' => ['class' => 'inline-block'],
                            ]);
                            $anonAnswer = AnonAnswer::all()->where('poll_id',$poll->id)->where('answer_id',$answer->id)->first();
                            $count=0;
                            if ($anonAnswer !=null) $count =$anonAnswer->count;
                            $form->add(uniqid(), 'static', [
                                'tag' => 'div', // Tag to be used for holding static data,
                                'attr' => ['class' => 'poll-awr-count'], // This is the default
                                'value' => $count,
                                'class' => 'poll-awr-count',
                                'label_show'=>false// If nothing is passed, data is pulled from model if any
                            ]);
                        };
                    } elseif ($answers->first()->type == "radiobutton"){
                        foreach ($answers as $answer){
                            $form->add($answer->title, 'radio', [
                                'value' => 1,
                                'checked' => true,
                                'label_attr' => ['class' => 'label-class'],
                                'wrapper' => ['class' => 'inline-block'],
                            ]);
                            $anonAnswer = AnonAnswer::all()->where('poll_id',$poll->id)->where('answer_id',$answer->id)->first();
                            $count=0;
                            if ($anonAnswer !=null) $count =$anonAnswer->count;
                            $form->add(uniqid(), 'static', [
                                'tag' => 'div', // Tag to be used for holding static data,
                                'attr' => ['class' => 'poll-awr-count'], // This is the default
                                'value' => $count,
                                'class' => 'poll-awr-count',
                                'label_show'=>false// If nothing is passed, data is pulled from model if any
                            ]);

                        };
                    }else{
                        foreach ($answers as $answer) {
                            $anonAnswer = AnonAnswer::all()->where('poll_id', $poll->id)->where('answer_id', $answer->id)->first();
                            $count = 0;
                            if ($anonAnswer != null) $count = $anonAnswer->count;
                            $form->add(uniqid(), 'static', [
                                'tag' => 'div', // Tag to be used for holding static data,
                                'attr' => ['class' => 'poll-awr-count-input'], // This is the default
                                'value' => $count,
                                'class' => 'poll-awr-count-input',
                                'label_show' => false// If nothing is passed, data is pulled from model if any
                            ]);
                            $commentAnswers = null;
                            if ($anonAnswer != null) $commentAnswers = CommentAnswer::all()->where('anon_answer_id', $anonAnswer->id);
                            if ($commentAnswers != null) {
                                foreach ($commentAnswers as $commentAnswer) {
                                    $form->add(uniqid(), 'textarea', [
                                        'label_show' => false,
                                        'value' => $commentAnswer->text,
                                        'attr' => ['readonly', 'rows' => '3'],
                                    ]);
                                }
                            }
                        }
                    }
            }
            return $form;
    }
    /*

                ;||($answers->first()->type == "radiobutton")){
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
        return view('poll.show',['poll'=>$poll]);
    }*/

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
    public function include(Request $request)
    {
        $poll = IncludedPolls::all()->where('included_poll_id',$request->included_poll_id)->where('poll_id',$request->poll_id)->first();
        if($poll != null) $poll->delete();
        else {
            $poll = new IncludedPolls();
            $poll->fill(['included_poll_id'=>$request->included_poll_id,'poll_id'=>$request->poll_id]);
            $poll->save();
        }

        return $data =1;
    }

}
