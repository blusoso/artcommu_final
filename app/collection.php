<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\post_has_collection;
use App\UserLikeCollection;

class collection extends Model
{
  use SoftDeletes;

  protected $table = 'collections';
  public $primaryKey = 'id';
  public $timestamps = true;
  protected $dates = ['deleted_at'];

  // public function image()
  // {
  //   return $this->hasMany('App\image','collection_id','id');
  // }

  public function user()
  {
    return $this->hasOne('App\user','id','user_id');
  }
  public function get_post_image(){
    $count_image = post_has_collection::where('collection_id',$this->id)->count();
    return $count_image;
  }
  public function find_collection($user_id){
    $find_collection = $this->where('user_id',$user_id)->count();
    return $find_collection;
  }

  public function follow_collection_count($collection_id)
  {
      $follow_collection_count = UserLikeCollection::where('collection_id', $collection_id)->where('is_fav', 1)->count();
      return $follow_collection_count;
  }



}
