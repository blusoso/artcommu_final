<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\postcontent;
use App\user;
use App\UserLikePost;
use Auth;

class post_has_collection extends Model
{
  protected $table = 'post_has_collections';
  public $primaryKey = 'id';
  public $timestamps = true;
  protected $dates = ['deleted_at'];

  public function post()
  {
    return $this->hasOne('App\postcontent','id', 'post_id');
  }
  public function find_image($collection_id){
    $find_image = $this->where('collection_id',$collection_id)->first();
    return $find_image;
  }

  public function collection()
  {
    return $this->hasOne('App\collection','id','collection_id');
  }

  public function find_user($post_id){
    $user_id = postcontent::where('id',$post_id)->first(['user_id']);
    $find_user = user::where('id',$user_id->user_id)->first();
    return $find_user;
  }

  public function fav_count($post_id)
  {
      $fav_count = UserLikePost::where('post_id', $post_id)->where('is_fav', 1)->count();
      return $fav_count;
  }
  public function favimg($post_id)
  {
      $favimg = UserLikePost::where('user_id', Auth::user()->id)->where('post_id', $post_id)->where('is_fav', 1)->first();
      return $favimg;
  }
}
