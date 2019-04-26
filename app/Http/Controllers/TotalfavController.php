<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\follow;
use App\UserLikePost;
use App\post_has_collection;
use App\postcontent;
use App\collection;

class TotalfavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
        $users = user::all();
        $user_id = user::where('username',$username)->first(['id']);
        $follows = follow::all();
        $user_follower_count = follow::where('following_id',$user_id->id)->where('is_follow',1)->count();
        $user_following_count = follow::where('owner_id',$user_id->id)->where('is_follow',1)->count();

        $userfav = UserLikePost::where('user_id',$user_id->id)->where('is_fav', 1);
        $total_fav = $userfav->count();
        $favorites = $userfav->orderBy('updated_at', 'desc')->get();

        $posts = postcontent::all();

        $post_has_collections = post_has_collection::all();
        $collections = collection::orderBy('updated_at', 'desc')->where('user_id', $user_id->id)->get();

        $UserLikePosts = UserLikePost::all();

        return view('totalfav')->with(array('users' => $users, 'username' => $username,
                                            'user_follower_count' => $user_follower_count,
                                            'user_following_count' => $user_following_count,
                                            'user_id' => $user_id, 'total_fav' => $total_fav,
                                            'userfav' => $userfav, 'follows' => $follows,
                                            'post_has_collections' => $post_has_collections,
                                            'favorites' => $favorites, 'posts' => $posts,
                                            'collections' => $collections, 'UserLikePosts' => $UserLikePosts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function fav(Request $request)
    {
      $fav = UserLikePost::find($request->input('favid'));
      // return $post;
      if ($fav->is_fav==0) {
        $fav->is_fav = 1;
      }
      else {
        $fav->is_fav = 0;
      }
      $fav->save();
      return $fav->is_fav;
    }
}
