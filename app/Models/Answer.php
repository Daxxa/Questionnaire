<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Answer extends Model
    {
        public $table = "answer";
        protected $fillable = ['title','type','question_id'];
        public function question()
        {
            return $this->belongsTo(Question::class);
        }
        public function anon_answers()
        {
            return $this->hasMany(AnonAnswer::class);
        }
    }

