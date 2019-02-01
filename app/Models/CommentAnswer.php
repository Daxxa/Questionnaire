<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentAnswer extends Model
{
    public $table = "comment_answer";
    protected $fillable = ['text','anon_answer_id'];
}
