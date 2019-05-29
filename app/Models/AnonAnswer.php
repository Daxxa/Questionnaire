<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnonAnswer extends Model
{
    public $table = "anon_answers";
    protected $fillable = ['title','poll_id','answer_id','anon_id'];

    public function comment_answers()
    {
        return $this->hasMany(CommentAnswer::class);
    }
}
