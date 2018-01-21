<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insight extends Model
{
    protected $table = 'insight';
    protected $fillable = ['id', 'insight'];
}
