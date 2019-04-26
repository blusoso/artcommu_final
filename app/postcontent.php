<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\UserLikePost;
use App\comment;
use App\follow;
use Auth;

class postcontent extends Model
{
    use SoftDeletes;

    protected $table = 'posts';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function likepost() {
      return $this->hasOne('App\UserLikePost', 'post_id', 'id');
    }

    public function comment() {
      return $this->hasOne('App\comment', 'post_id', 'id');
    }

    public function posthascollection()
    {
      return $this->hasOne('App\post_has_collection','post_id', 'id');
    }

    public function fav_count($post_id)
    {
        $fav_count = UserLikePost::where('post_id', $post_id)->where('is_fav', 1)->count();
        return $fav_count;
    }

    public function comment_count($post_id)
    {
        $comment_count = comment::where('post_id', $post_id)->count();
        return $comment_count;
    }
    public function is_follow($user_id)
    {
        $is_follow = follow::where('following', $user_id)->where('is_follow', 1)->get();
        return $is_follow;
    }
}
