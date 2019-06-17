<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string title
 * @property string text
 * @property integer user_id
 */
class Poll extends Model
{
    public $table = "poll";
    protected $fillable = ['title','text'];

    /**
     * @return string
     */

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function polls()
    {
        return $this->belongsToMany(Poll::class, 'included_polls', 'poll_id', 'included_poll_id');
    }

    public function allQuestions()
    {
        $polls = $this->polls()->get();
        $questions = $this->questions()->get();
        $all = $questions;
        foreach ($polls as $poll){
            $all = $all->toBase()->merge($poll->questions()->get());

        }
        return $all;

    }

}
