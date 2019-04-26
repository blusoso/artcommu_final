<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $table = 'images';
    public $primaryKey = 'id';
    public $timestamps = true;
}
