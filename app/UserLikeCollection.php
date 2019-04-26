<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\post_has_collection;
use App\postcontent;

class UserLikeCollection extends Model
{
  protected $table = 'user_like_collections';
  public $primaryKey = 'id';
  public $timestamps = true;

  public function collection()
  {
    return $this->hasOne('App\collection', 'id', 'collection_id');
  }

  public function collection_fav_count($collection_id)
  {
    $collection_fav_count = $this->where('collection_id', $collection_id)->where('is_fav', 1)->count();
    return $collection_fav_count;
  }

  public function get_post_has_collection($collection_id)
  {
    $post_has_collection = post_has_collection::where('collection_id', $collection_id)->get();
    return $post_has_collection;
  }
  public function get_post($post_id)
  {
    $get_post = postcontent::where('id', $post_id)->first();
    return $get_post;
  }
  public function get_post_count($collection_id)
  {
    $get_post_count = post_has_collection::where('collection_id', $collection_id)->count();
    return $get_post_count;
  }

  public function get_owner_collection($user_id)
  {
    $get_owner_collection = user::where('id', $user_id)->first();
    return $get_owner_collection;
  }

  public function get_peoplelike_collection($collection_id)
  {
    $get_peoplelike_collection = $this->where('collection_id', $collection_id)->get();
    return $get_peoplelike_collection;
  }

  public function get_like_count($collection_id)
  {
    $get_like_count = $this->where('collection_id', $collection_id)->where('is_fav', 1)->count();
    return $get_like_count;
  }
  public function user()
  {
    return $this->hasOne('App\user', 'id', 'user_id');
  }
}
