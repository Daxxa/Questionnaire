<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anon extends Model
{
    public $table = "anons";
    protected $fillable = ['ip','browser'];
}
