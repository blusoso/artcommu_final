<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLikeComment extends Model
{
  protected $table = 'user_like_comments';
  public $primaryKey = 'id';
  public $timestamps = true;
}
