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

}
