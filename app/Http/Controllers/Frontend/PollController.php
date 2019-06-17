<?php

namespace App\Http\Controllers\Frontend;

use App\Forms\PassPollForm;
use App\Http\Requests\addPassPollRequest;
use App\Models\Anon;
use App\Models\AnonAnswer;
use App\Models\Answer;
use App\Models\CommentAnswer;
use App\Models\IncludedPolls;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Url;
use Illuminate\Database\Eloquent\Collection;
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
    public function show(Request $request, $unique, FormBuilder $formBuilder)
    {
        $anon = $this->addOrUpdateAnon($request);
        $form = $formBuilder->create(PassPollForm::class, [
            'method' => 'POST',
            'url' => route('questionnaire.store'),
        ]);
        $url = Url::where('url',$unique)->first();
        $poll = Poll::findOrFail($url->poll_id);
        $answers = $poll->questions()->get()->first()->answers()->get();
        $anon = AnonAnswer::where('anon_id',$request->session()->get('anon_id'))->where('poll_id',$poll->id)->get()->toArray();
        if (count($anon) == 0){
            if ($url->count()!=0) {
                $questions =$this->getQuestions($url->poll_id);
                foreach ($questions as $question){
                    $answers = Answer::all()->where('question_id',$question->id);
                    if($answers->count() != 0){
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
                        }else if(($answers->first()->type == "numberInput")){
                            $form->add($answers->first()->id, 'number',[
                                'rules' => 'required|min:0',
                                'label'=>$question->text,
                                'label_show'=>true,
                                'label_attr' => ['class' => 'poll-qtn-text', 'for' => $question->text],
                            ]);
                        }else if($answers->first()->type == "map") {
                            $form->add(uniqid(), 'static', [
                                'label'=>$question->text,
                                'label_attr' => ['class' => 'poll-qtn-text'],
                                'tag' => 'div', // Tag to be used for holding static data,
                                'attr' => ['class' => 'map', 'id' => 'map', 'answerId' => $answers->first()->id], // This is the default
                                'value' => $answers->first()->title // If nothing is passed, data is pulled from model if any
                            ])

                            ->add($answers->first()->id, 'text',[
                                'attr' => ['placeholder' => 'Place', 'class' => 'form-control coordinate'],
                                'label'=>"Place",
                                'label_show'=>true,
                            ]);
                        }else
                        {
                            $form->add($answers->first()->id, 'textarea',[
                                'rules' => 'required|min:5',
                                'label'=>$question->text,
                                'label_show'=>true,
                                'label_attr' => ['class' => 'poll-qtn-text', 'for' => $question->text],
                            ]);
                        }
                        $form->add(uniqid(), 'static', [
                            'tag' => 'div', // Tag to be used for holding static data,
                            'attr' => ['class' => 'extra'], // This is the default
                            'value' => $question->extra,
                            'label_show' => false// If nothing is passed, data is pulled from model if any
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
        } else {
            return view('error.exist');
        }

    }
    private function getQuestions($poll_id)
    {
        $poll = Poll::where('id', $poll_id)->first();
        $questions = Question::all()->where('poll_id', $poll->id);
        $included_polls = IncludedPolls::all()->where('poll_id',$poll->id);
        $included_questions =new Collection();
        foreach ($included_polls as $one)
            $included_questions =$included_questions->merge(Question::all()->where('poll_id',$one->included_poll_id));
        $questions = $questions->merge($included_questions);
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
           //dd($data);
           $poll_id = $request->input('poll_id');
           foreach($data as $id => $value){
               var_dump($id);

               if (is_array($value)) {
                   foreach ($value as $one) {
                       $this->addOrUpdate($poll_id, $one);
                   }
               }elseif ($id !='poll_id'){
                   $answer = Answer::all()->where('id', $value)->where('question_id', $id);
                   if (count($answer)){
                       $this->addOrUpdate($poll_id, $value);
                   }else {
                       $text = $value;
                       $value = $id;
                       $anonAnswerId = $this->addOrUpdate($poll_id, $value);
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
    private function addOrUpdate($poll_id, $one)
    {
        $answer = Answer::findOrFail($one);
        if ($answer != null)
        $answer->question()->first()->answers()->get();
        $anonAnswer = AnonAnswer::where('poll_id', $poll_id)->where('answer_id', $one)->where('anon_id', session()->get('anon_id'))->first();
        if ($anonAnswer == null) {
            $anonAnswer = new AnonAnswer();
            $anonAnswer->poll_id = $poll_id;
            $anonAnswer->answer_id = $one;
            $anonAnswer->anon_id = session()->get('anon_id');
            $anonAnswer->save();
        } else {
            DB::table('anon_answers')->where('id', $anonAnswer->id)->update($anonAnswer->toArray());
        }
        return $anonAnswer->id;
    }
    private function addOrUpdateAnon(Request $request)
    {

        $anon = new Anon();
        $anon->ip = $request->server('SERVER_NAME');
        $anon->browser = $request->server('HTTP_USER_AGENT');
        $anonExisted = Anon::all()->where('ip', $anon->ip )->where('browser', $anon->browser)->first();
        if ($anonExisted == null){
            $anon->save();
            session()->put('anon_id', $anon->id);
            return $anon;
        }
        session()->put('anon_id', $anonExisted->id);

        return $anonExisted;
    }

    private function checkAnonInPoll()
    {
        $anon = AnonAnswer::all()->where('poll_id', $poll_id)->where('anon_id', $anon_id)->first();
        if ($anon == null){
            return true;
        }
        return false;
    }
}
