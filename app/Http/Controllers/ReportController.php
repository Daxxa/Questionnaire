<?php

namespace App\Http\Controllers;

use App\Models\AnonAnswer;
use App\Models\Answer;
use App\Models\Poll;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Knp\Snappy\Pdf;

class ReportController extends Controller
{
    public function report1(Poll $poll)
    {
        $data = $this->reports1($poll);
        return view("reports.report1", ["reports" => $data['reports'], 'prev' => null, 'anonCount' => $data['anonCount'], 'questionCount' => $data['questionCount'], 'poll' => $poll]);
    }

    public function report2(Poll $poll, Question $question = null)
    {
        if ($question == null)
        {
            $question = Question::where('poll_id', $poll->id)->first();
        }

        $polls = $poll->polls()->get()->pluck('id')->toArray();
        array_push($polls, $poll->id);

        $questions = Question::whereIn('poll_id', $polls)->get();
        $data = $this->reports2($poll, $question);
        $chart = ($data['reports']);
        $array = array();
        $array2 = array();
        foreach ($chart as $one)
        {
            $tmp_array = array("y" => $one->Co, 'label' => $one->Answer,);
            array_push($array, $tmp_array);
            $tmp_array = array("y" => $one->Count, 'label' => $one->Answer,);
            array_push($array2, $tmp_array);
        }
        $chart = json_encode($array, JSON_NUMERIC_CHECK);
        $chart2 = json_encode($array2, JSON_NUMERIC_CHECK);
        return view("reports.report2", ["reports" => $data['reports'], 'prev' => null, 'anonCount' => $data['anonCount'], 'questionCount' => $data['questionCount'], 'chart'=>$chart,
            'chart2'=>$chart2, 'poll' => $poll, 'questions' => $questions]);
    }

    public function report2Post(Request $request)
    {
        $q = Question::findOrFail($request->question);
        $poll = Poll::findOrFail($request->poll);
        $data = $this->reports2($poll, $q);

        $chart = ($data['reports']);
        $array = array();
        $array2 = array();
        foreach ($chart as $one)
        {
            $tmp_array = array("y" => $one->Co, 'label' => $one->Answer,);
            array_push($array, $tmp_array);
            $tmp_array = array("y" => $one->Count, 'label' => $one->Answer,);
            array_push($array2, $tmp_array);
        }
        $chart = json_encode($array, JSON_NUMERIC_CHECK);
        $chart2 = json_encode($array2, JSON_NUMERIC_CHECK);

        $pdf = \PDF::loadView('reports.report2PDF', ["reports" => $data['reports'], 'prev' => null, 'chart'=>$chart,
            'chart2'=>$chart2, 'anonCount' => $data['anonCount'], 'questionCount' => $data['questionCount'],
            'poll' => $poll, 'img1'=>$request->img1, 'img2'=>$request->img2]);

        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 50000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->stream('report2.pdf');
    }

    public function generatePDF(Poll $poll)
    {
        $data = $this->reports1($poll);

        $pdf = \PDF::loadView('reports.report1PDF', ["reports" => $data['reports'], 'prev' => null, 'anonCount' => $data['anonCount'], 'questionCount' => $data['questionCount'],
            'poll' => $poll]);

        return $pdf->stream('report1.pdf');
    }

    public function generatePDF2(Poll $poll, $question_id)
    {


        $q = Question::findOrFail($question_id);
        $data = $this->reports2($poll, $q);

        $chart = ($data['reports']);
        $array = array();
        $array2 = array();
        foreach ($chart as $one)
        {
            $tmp_array = array("y" => $one->Co, 'label' => $one->Answer,);
            array_push($array, $tmp_array);
            $tmp_array = array("y" => $one->Count, 'label' => $one->Answer,);
            array_push($array2, $tmp_array);
        }
        $chart = json_encode($array, JSON_NUMERIC_CHECK);
        $chart2 = json_encode($array2, JSON_NUMERIC_CHECK);

        $pdf = \PDF::loadView('reports.report2PDF', ["reports" => $data['reports'], 'prev' => null, 'chart'=>$chart,
            'chart2'=>$chart2, 'anonCount' => $data['anonCount'], 'questionCount' => $data['questionCount'],
            'poll' => $poll]);

        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 50000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->stream('report2.pdf');
        /*
        $q = Question::findOrFail($question_id);
        $data = $this->reports2($poll, $q);

        $pdf = PDF::loadView('reports.report2PDF', ["reports" => $data['reports'], 'prev' => null, 'anonCount' => $data['anonCount'], 'questionCount' => $data['questionCount'],
            'poll' => $poll]);

        return $pdf->stream('report1.pdf');*/
    }
    public function test(Poll $poll, $question_id){
        $q = Question::findOrFail($question_id);
        $data = $this->reports2($poll, $q);

        $chart = ($data['reports']);
        $array = array();
        $array2 = array();
        foreach ($chart as $one)
        {
            $tmp_array = array("y" => $one->Co, 'label' => $one->Answer,);
            array_push($array, $tmp_array);
            $tmp_array = array("y" => $one->Count, 'label' => $one->Answer,);
            array_push($array2, $tmp_array);
        }
        $chart = json_encode($array, JSON_NUMERIC_CHECK);
        $chart2 = json_encode($array2, JSON_NUMERIC_CHECK);
        return view('reports.report2PDF', ["reports" => $data['reports'], 'prev' => null, 'chart'=>$chart,
            'chart2'=>$chart2, 'anonCount' => $data['anonCount'], 'questionCount' => $data['questionCount'],
            'poll' => $poll]);
    }

    public function reports1(Poll $poll)
    {
        $polls = $poll->polls()->get()->pluck('id')->toArray();
        array_push($polls, $poll->id);
        $answer = DB::table('answer')
            ->select(DB::raw('question.id as question_id, count(anon_answers.id) as count'))
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('anon_answers', 'answer.id', '=', 'anon_answers.answer_id')
            ->groupBy('question.id')
            ->whereIn('question.poll_id', $polls)
            ->where('anon_answers.poll_id', $poll->id)
            ->get();
        $answers = array_column($answer->toArray(), 'count', 'question_id');

        $reports1 = DB::table('answer')
            ->select(DB::raw('question.id as Qid, question.title as Question,  answer.title as Answer, answer.id as AnswerId, anon_answers.id, question.id as Co'))
            ->selectRaw('IF(anon_answers.id > -1 ,  count(answer.id), 0) as Count')
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('poll', 'poll.id', '=', 'question.poll_id')
            ->leftJoin('anon_answers', 'answer.id', '=', 'anon_answers.answer_id')
            ->groupBy('answer.id')
            ->whereIn('poll.id', $polls)
            ->where('anon_answers.poll_id', $poll->id)
            ->orWhereNull('anon_answers.id')
            ->whereIn('poll.id', $polls)
            ->orderBy('Question')
            ->get();

        $reports = DB::table('answer')
            ->select(DB::raw('question.id as Qid, question.title as Question,  answer.title as Answer, answer.id as AnswerId, question.id as Co, 0 as Count'))
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('poll', 'poll.id', '=', 'question.poll_id')
            ->groupBy('answer.id')
            ->whereIn('poll.id', $polls)
            ->orderBy('Question')
            ->get();

        foreach ($reports as $one)
        {
            $tmp = $reports1->where('AnswerId', $one->AnswerId)->first();
            if ($tmp != null) $one->Count = $tmp->Count;
            else  $one->Count = 0;
        }
        $anons = count(DB::table('anon_answers')
            ->groupBy('anon_answers.anon_id')
            ->where('anon_answers.poll_id', $poll->id)
            ->get()->toArray());
        $questions = count(DB::table('question')
            ->whereIn('question.poll_id', $polls)
            ->get());
        foreach ($reports as $report)
        {
            if(count($answers) && isset($answers[$report->Qid]))
            $report->Co = number_format($report->Count / $answers[$report->Co] * 100, 2, '.', '');
            else $report->Co = 0;
        }
        return ["reports" => $reports, 'prev' => null, 'anonCount' => $anons, 'questionCount' => $questions];
    }

    public function reports2(Poll $poll, Question $question)
    {
        if (!isset($question)) $question = Question::where('poll_id', $poll->id)->first();
        $polls = $poll->polls()->get()->pluck('id')->toArray();
        array_push($polls, $poll->id);
        $answer = DB::table('answer')
            ->select(DB::raw('question.id as question_id, count(anon_answers.id) as count'))
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('anon_answers', 'answer.id', '=', 'anon_answers.answer_id')
            ->groupBy('question.id')
            ->whereIn('question.poll_id', $polls)
            ->where('question.id', $question->id)
            ->where('anon_answers.poll_id', $poll->id)
            ->get();

        $answers = array_column($answer->toArray(), 'count', 'question_id');

        $reports1 = DB::table('answer')
            ->select(DB::raw('question.id as Qid, question.title as Question,  answer.title as Answer, answer.id as AnswerId, anon_answers.id, question.id as Co'))
            ->selectRaw('IF(anon_answers.id > -1 ,  count(answer.id), 0) as Count')
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('poll', 'poll.id', '=', 'question.poll_id')
            ->leftJoin('anon_answers', 'answer.id', '=', 'anon_answers.answer_id')
            ->groupBy('answer.id')
            ->whereIn('poll.id', $polls)
            ->where('anon_answers.poll_id', $poll->id)
            ->where('question.id', $question->id)
            ->orWhereNull('anon_answers.id')
            ->whereIn('poll.id', $polls)
            ->where('question.id', $question->id)
            //->whereIn('anon_answers.anon_id', $anons)
            ->orderBy('Question')
            ->get();

        $reports = DB::table('answer')
            ->select(DB::raw('question.id as Qid, question.title as Question,  answer.title as Answer, answer.id as AnswerId, question.id as Co, 0 as Count'))
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('poll', 'poll.id', '=', 'question.poll_id')
            ->groupBy('answer.id')
            ->whereIn('poll.id', $polls)
            ->where('question.id', $question->id)
            ->orderBy('Question')
            ->get();

        foreach ($reports as $one)
        {
            $tmp = $reports1->where('AnswerId', $one->AnswerId)->first();
            if ($tmp != null) $one->Count = $tmp->Count;
            else  $one->Count = 0;
        }

        $anons = count(DB::table('anon_answers')
            ->groupBy('anon_answers.anon_id')
            ->where('anon_answers.poll_id', $poll->id)
            ->get()->toArray());
        $questions = count(DB::table('question')
            ->whereIn('question.poll_id', $polls)
            ->get());
        foreach ($reports as $report)
        {
            if(count($answers))
                $report->Co = number_format($report->Count / $answers[$report->Co] * 100, 2, '.', '');
            else $report->Co = 0;
        }
        return ["reports" => $reports, 'prev' => null, 'anonCount' => $anons, 'questionCount' => $questions];
    }

    public function report3(Poll $poll, $question, $answer)
    {
        $question = Question::findOrFail($question);
        $answer = Answer::findOrFail($answer);
        $questions = $poll->allQuestions();
        $data = $this->reports3($poll, $question, $answer);
        return view("reports.report3", ["reports" => $data['reports'], 'prev' => null, 'anonCount' => $data['anonCount'], 'questionCount' => $data['questionCount'], 'poll' => $poll, 'questions' => $questions, 'defaultQuestion' => $question, 'defaultAnswer' => $answer]);
    }

    public function reports3(Poll $poll, Question $question, Answer $answer)
    {
        if (!isset($question)) $question = Question::where('poll_id', $poll->id)->first();
        if (!isset($answer)) $answer = Answer::where('question_id', $question->id)->first();

        $polls = $poll->polls()->get()->pluck('id')->toArray();
        array_push($polls, $poll->id);
        $anons = AnonAnswer::where('answer_id', $answer->id)->whereIn('poll_id', $polls)->get()->pluck('anon_id');

        $answer = DB::table('answer')
            ->select(DB::raw('question.id as question_id, count(anon_answers.id) as count'))
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('anon_answers', 'answer.id', '=', 'anon_answers.answer_id')
            ->groupBy('question.id')
            ->whereIn('question.poll_id', $polls)
            ->where('anon_answers.poll_id', $poll->id)
            ->whereIn('anon_answers.anon_id', $anons)
            ->get();
        // question and count of anon_answers
        $answers = array_column($answer->toArray(), 'count', 'question_id');
        $reports1 = DB::table('answer')
            ->select(DB::raw('question.id as Qid, question.title as Question,  answer.title as Answer, answer.id as AnswerId, anon_answers.id, question.id as Co'))
            ->selectRaw('IF(anon_answers.id > -1 ,  count(answer.id), 0) as Count')
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('poll', 'poll.id', '=', 'question.poll_id')
            ->leftJoin('anon_answers', 'answer.id', '=', 'anon_answers.answer_id')
            ->groupBy('answer.id')
            ->whereIn('poll.id', $polls)
            ->where('anon_answers.poll_id', $poll->id)
            ->whereIn('anon_answers.anon_id', $anons)
            ->orWhereNull('anon_answers.id')
            ->whereIn('poll.id', $polls)
            //->whereIn('anon_answers.anon_id', $anons)
            ->orderBy('Question')
            ->get();
        //dd($reports);
        $reports = DB::table('answer')
            ->select(DB::raw('question.id as Qid, question.title as Question,  answer.title as Answer, answer.id as AnswerId, 0 as Count'))
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('poll', 'poll.id', '=', 'question.poll_id')
            ->groupBy('answer.id')
            ->whereIn('poll.id', $polls)
            ->orderBy('Question')
            ->get();
        foreach ($reports as $one)
        {
            $tmp = $reports1->where('AnswerId', $one->AnswerId)->first();
            if ($tmp != null) $one->Count = $tmp->Count;
            else  $one->Count = 0;
        }
        $anons = count($anons);

        $questions = count(DB::table('question')
            ->whereIn('question.poll_id', $polls)
            ->get());
        foreach ($reports as $report)
        {
            if(count($answers) && isset($answers[$report->Qid]))
            $report->Qid = number_format($report->Count / $answers[$report->Qid] * 100, 2, '.', '');
            else $report->Qid = 0;
        }
        return ["reports" => $reports, 'prev' => null, 'anonCount' => $anons, 'questionCount' => $questions];
    }
    public function returnAnswers(Request $request)
    {
        $question = Question::findOrFail($request->question_id);
        if ($question->answers()->get()->first()->type == 'radiobutton' || $question->answers()->get()->first()->type == 'checkbox'){
            $answers = $question->answers()->get()->pluck('title', 'id')->toArray();
            $data['type'] = 'multiply';
            $data['answers'] = $answers;
            return json_encode($data, JSON_NUMERIC_CHECK);
        }else if ($question->answers()->get()->first()->type == 'numberInput'){
            $all_answers = $question->answers()->first()->anon_answers()->get();
            $answers = new Collection();
            foreach ($all_answers as $answer)
            {
                $answers->push($answer->comment_answers()->first());
            }
            $answers->map(function ($name, $key){
                return $name['text'] =  (double)$name['text'];
            });
            $min = ($answers->min('text'));
            $max = ($answers->max('text'));
            $step = ($max - $min) / 99;
            $data['type'] = 'numberInput';
            $data['min'] = $min;
            $data['max'] = $max;
            $data['step'] =  number_format($step, 2, '.', '');
            $data['answers'] = $answers;
            return json_encode($data);
        } else if ($question->answers()->get()->first()->type == 'input'){
            $data['type'] = 'input';
            return json_encode($data);
        } else if ($question->answers()->get()->first()->type == 'map'){
            $data['type'] = 'map';
            $all_answers = $question->answers()->get()->first()->anon_answers()->get();
            $coordinates = array();
            foreach ($all_answers as $answer)
            {
                $coordinate = explode(', ', $answer->comment_answers()->first()->text) ;
                $coordinate[0] = (double)$coordinate[0];
                $coordinate[1] = (double)$coordinate[1];
                array_push($coordinates, $coordinate);
            }
            $data['coordinates'] = $coordinates;
            return json_encode($data);
        }

    }
    public function returnRange(Request $request)
    {
        $poll = Poll::where('id', $request->get('poll')['id'])->first();
        $question = Question::where('poll_id', $poll->id)->where('id', $request->get('question_id'))->first();
        $answer = Answer::where('question_id', $question->id)->first();

        $polls = $poll->polls()->get()->pluck('id')->toArray();
        array_push($polls, $poll->id);

        $reports0 = DB::table('answer')
            ->select(DB::raw('question.id as Qid, question.title as Question,  answer.title as Answer, answer.id as AnswerId, anon_answers.id as THIS, question.id as Co, comment_answer.text as Number'))
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('poll', 'poll.id', '=', 'question.poll_id')
            ->leftJoin('anon_answers', 'answer.id', '=', 'anon_answers.answer_id')
            ->rightJoin('comment_answer', 'comment_answer.anon_answer_id', '=', 'anon_answers.id' )
            ->whereIn('poll.id', $polls)
            ->where('anon_answers.poll_id', $poll->id)
            ->where('question.id', $question->id)
            ->orderBy('Question')
            ->get();
        foreach ($reports0 as $key => $one)
        {
            $one->Number = (double)$one->Number;
            if ($one->Number < $request->get('min') || $one->Number > $request->get('max'))
            {
                $reports0->forget($key);
            }
        }
        $reports0 = $reports0->pluck('THIS');

        $anons = AnonAnswer::where('answer_id', $answer->id)->whereIn('poll_id', $polls)->whereIn('id', $reports0)->get()->pluck('anon_id');

        $answer = DB::table('answer')
            ->select(DB::raw('question.id as question_id, count(anon_answers.id) as count'))
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('anon_answers', 'answer.id', '=', 'anon_answers.answer_id')
            ->groupBy('question.id')
            ->whereIn('question.poll_id', $polls)
            ->where('anon_answers.poll_id', $poll->id)
            ->whereIn('anon_answers.anon_id', $anons)
            ->get();
        // question and count of anon_answers
        $answers = array_column($answer->toArray(), 'count', 'question_id');


        $reports1 = DB::table('answer')
            ->select(DB::raw('question.id as Qid, question.title as Question,  answer.title as Answer, answer.id as AnswerId, anon_answers.id, question.id as Co'))
            ->selectRaw('IF(anon_answers.id > -1 ,  count(answer.id), 0) as Count')
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('poll', 'poll.id', '=', 'question.poll_id')
            ->leftJoin('anon_answers', 'answer.id', '=', 'anon_answers.answer_id')
            ->groupBy('answer.id')
            ->whereIn('poll.id', $polls)
            ->where('anon_answers.poll_id', $poll->id)
            ->whereIn('anon_answers.anon_id', $anons)
            ->orWhereNull('anon_answers.id')
            ->whereIn('poll.id', $polls)
            //->whereIn('anon_answers.anon_id', $anons)
            ->orderBy('Question')
            ->get();
        //dd($reports);
        $reports = DB::table('answer')
            ->select(DB::raw('question.id as Qid, question.title as Question,  answer.title as Answer, answer.id as AnswerId, 0 as Count, 0 as Number'))
            ->join('question', 'question.id', '=', 'answer.question_id')
            ->join('poll', 'poll.id', '=', 'question.poll_id')
            ->groupBy('answer.id')
            ->whereIn('poll.id', $polls)
            ->orderBy('Question')
            ->get();
        foreach ($reports as $one)
        {
            $tmp = $reports1->where('AnswerId', $one->AnswerId)->first();
            if ($tmp != null) {
                $one->Count = $tmp->Count;
            }
            else  $one->Count = 0;
        }
        $anons = count($anons);

        $questions = count(DB::table('question')
            ->whereIn('question.poll_id', $polls)
            ->get());
        foreach ($reports as $report)
        {
            if(count($answers) && isset($answers[$report->Qid]))
                $report->Qid = number_format($report->Count / $answers[$report->Qid] * 100, 2, '.', '');
            else $report->Qid = 0;
        }
        return ["reports" => $reports, 'prev' => null, 'anonCount' => $anons, 'questionCount' => $questions, 'question_title' => $question->title, 'answer_title' => $request->get('min').' - '.$request->get('max')];

    }


}
