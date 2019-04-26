<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\postcontent;
use App\user;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLikePost extends Model
{
  use SoftDeletes;

  protected $table = 'user_like_posts';
  public $primaryKey = 'id';
  public $timestamps = true;

  public function user()
  {
    return $this->hasOne('App\user', 'id', 'user_id');
  }

  public function post() {
    return $this->hasOne('App\postcontent', 'id', 'post_id');
  }

  public function findUser($post_id) {
    $post = postcontent::where('id', $post_id)->first(['user_id']);
    $user = user::where('id', $post->user_id)->first();
    return $user;
  }

  public function owner_fav($user_id, $post_id) {
    $owner_fav = $this->where('user_id',$user_id)->where('post_id', $post_id)->count();
    return $owner_fav;
  }

  public function fav_count($post_id)
  {
      $fav_count = UserLikePost::where('post_id', $post_id)->where('is_fav', 1)->count();
      return $fav_count;
  }
}
