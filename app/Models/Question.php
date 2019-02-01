<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * @property string title
 * @property string text
 * @property integer poll_id
 */
class Question extends Model
{
    public $table = "question";
    protected $fillable = ['title', 'text', 'poll_id', 'created_at', 'updated_at'];


}
