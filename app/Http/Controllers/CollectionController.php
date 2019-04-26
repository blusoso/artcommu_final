<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\collection;
use App\sorting_collection;
use App\post_has_collection;
use App\postcontent;
use App\follow;
use App\UserLikeCollection;
use App\UserLikePost;

class CollectionController extends Controller
{
  public function index($username) {
      $users = user::all();
      $user_id = user::where('username',$username)->first(['id']);
      $sorting_collections = sorting_collection::all();
      $collections = collection::orderBy('updated_at', 'desc')->where('user_id', $user_id->id)->get();
      $post_has_collections = post_has_collection::all();
      $posts = postcontent::all();
      $follows = follow::all();
      $user_like_collections = UserLikeCollection::all();

      $userfav = UserLikePost::where('user_id',$user_id->id)->where('is_fav', 1);
      $total_fav = $userfav->count();
      $user_follower_count = follow::where('following_id',$user_id->id)->where('is_follow',1)->count();
      $user_following_count = follow::where('owner_id',$user_id->id)->where('is_follow',1)->count();

      $collection_count = post_has_collection::all();

      // return $userfavpost;

      return view('collection')->with(array('users' => $users, 'collections' => $collections,
                                            'sorting_collections' => $sorting_collections,
                                            'post_has_collections' => $post_has_collections,
                                            'posts' => $posts, 'username' => $username,
                                            'follows' => $follows, 'user_like_collections' => $user_like_collections,
                                            'total_fav' => $total_fav, 'user_follower_count' => $user_follower_count,
                                            'user_following_count' => $user_following_count));
  }

  public function sorting(Request $request, $id, $username) {
    $users = user::all();
    $post_has_collections = post_has_collection::all();
    $posts = postcontent::all();
    $user_like_collections = UserLikeCollection::all();

    if ($request->input('id') == 1) {
      $collections = collection::orderBy('updated_at', 'desc')->where('user_id', $id)->get();
    } else if ($request->input('id') == 2) {
      $collections = collection::orderBy('title','asc')->where('user_id', $id)->get();
    } else if ($request->input('id') == 3) {
      $collections = collection::orderBy('id','desc')->where('user_id', $id)->get();
    } else if ($request->input('id') == 4) {
      $collections = collection::orderBy('id','asc')->where('user_id', $id)->get();
    } else {
      $collections = collection::orderBy('id','desc')->where('user_id', $id)->get();
    }
    // return $collections;
    return view('collection-list',['collections' => $collections, 'post_has_collections' => $post_has_collections,
                                  'posts' => $posts, 'username' => $username,
                                  'user_like_collections' => $user_like_collections,
                                  'users' => $users]);
    // return view('profile');
  }

  public function insert(Request $request) {
      $collection = new collection;
      $collection->title = $request->input('collection-name');
      $check = $request->has('private-chk')? true : false;
      $collection->is_private = $check;
      $collection->user_id = $request->input('user_id');
      $collection->save();

      return back();
  }

  public function update(Request $request) {
      $collection = collection::find($request->input('collection-id'));
      $collection->title = $request->input('collection-name');
      $collection->description = $request->input('collection-description');
      $collection->is_private = $request->input('private-chk');
      $collection->save();

      return back();
  }

  public function destroy(Request $request)
  {
      $collection = collection::find($request->input('id'));
      $collection->delete();
  }
  public function fav(Request $request)
  {
      $like_collection = UserLikeCollection::where('user_id',$request->user_id)->where('collection_id',$request->collection_id);
      $count_collection = $like_collection->count();
      $collection = collection::find($request->input('collection_id'));
      if ($count_collection > 0) {
        $favcollectiontoggle = $like_collection->first();
        if ($favcollectiontoggle->is_fav==0) {
          $favcollectiontoggle->is_fav = 1;
        }
        else {
          $favcollectiontoggle->is_fav = 0;
        }
        $favcollectiontoggle->save();
        return array($favcollectiontoggle->is_fav, $count_collection);
      }else{
        $favcollection = new UserLikeCollection;
        $favcollection->user_id = $request->user_id;
        $favcollection->collection_id = $request->collection_id;
        $favcollection->is_fav = 1;
        $favcollection->save();
        return array($favcollection->is_fav, $count_collection);
      }
  }
  public function show($username, $title, $id)
  {
      $users = user::all();
      $collections = collection::all();
      $post_has_collections = post_has_collection::orderBy('created_at','desc')->get()->where('collection_id', $id);
      $posts = postcontent::all();
      $user_like_posts = UserLikePost::all();
      return view('fav-image')->with(array('users' => $users, 'collections' => $collections,
                                           'posts' => $posts, 'post_has_collections' => $post_has_collections,
                                           'username' => $username, 'title' => $title, 'id' => $id,
                                           'user_like_posts' => $user_like_posts));
  }
  public function delete(Request $request)
  {
      $post_has_collection = post_has_collection::find($request->input('id'));
      $post_has_collection->delete();
  }

  public function followingcollection($username)
  {
      $users = user::all();
      $user_id = user::where('username',$username)->first(['id']);
      $follows = follow::all();
      $user_follower_count = follow::where('following_id',$user_id->id)->where('is_follow',1)->count();
      $user_following_count = follow::where('owner_id',$user_id->id)->where('is_follow',1)->count();
      $userfav = UserLikePost::where('user_id',$user_id->id)->where('is_fav', 1);
      $total_fav = $userfav->count();
      $user_like_collection = UserLikeCollection::where('user_id', $user_id->id)->where('is_fav',1);
      $user_like_collections = $user_like_collection->get();
      $UserLikeCollections = UserLikeCollection::all();
      $posts = postcontent::all();

      return view('followingcollection')->with(array('users' => $users, 'username' => $username,
                                          'user_follower_count' => $user_follower_count,
                                          'user_following_count' => $user_following_count,
                                          'user_id' => $user_id, 'follows' => $follows,
                                          'userfav' => $userfav, 'total_fav' => $total_fav,
                                          'user_like_collections' => $user_like_collections,
                                          'UserLikeCollections' => $UserLikeCollections, 'posts' =>$posts
                                        ));
  }

}
