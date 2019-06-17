<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.index', ['users' => $users]);
    }

    public function polls(User $user)
    {
        $polls = Poll::where('user_id', $user->id)->get();
        return view('admin.polls', ['polls' => $polls, 'user' => $user]);
    }

    public function questions(Poll $poll, User $user)
    {
        $questions = $poll->questions()->get();
        return view('admin.questions', ['questions' => $questions, 'poll' => $poll, 'user' => $user]);
    }

    public function answers(Poll $poll, Question $question, User $user)
    {
        $answers = $question->answers()->get();
        return view('admin.answers', ['poll'=>$poll, 'question'=>$question, 'answers' => $answers, 'user' => $user]);
    }

    public function block()
    {
        $polls = Poll::where('user_id', Auth::user()->getAuthIdentifier())->get();
        return view('admin.block', ['polls' => $polls]);
    }
}