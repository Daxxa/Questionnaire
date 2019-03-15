<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncludedPolls extends Model
{
    public $table = "included_polls";
   protected $fillable = ['poll_id','included_poll_id'];
}
