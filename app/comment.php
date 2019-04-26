<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\UserLikeComment;

class comment extends Model
{
  use SoftDeletes;

  protected $table = 'comments';
  public $primaryKey = 'id';
  public $timestamps = true;
  protected $dates = ['deleted_at'];

  public function user()
  {
    return $this->hasOne('App\user','id', 'user_id');
  }

  public function post()
  {
    return $this->hasOne('App\postcontent','id', 'post_id');
  }

  public function fav_comment_count($comment_id)
  {
    $fav_comment_count = UserLikeComment::where('comment_id', $comment_id)->where('is_fav', 1)->count();
    return $fav_comment_count;
  }

}
