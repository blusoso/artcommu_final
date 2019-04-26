<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\user;
use App\postcontent;
use App\collection;
use App\comment;
use App\follow;
use App\UserLikePost;
use App\UserLikeComment;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
        $users = user::all();
        $collections = collection::all();
        $posts = postcontent::orderBy('id', 'DESC')->get();
        $comments = comment::all();
        $follows = follow::all();
        $user_like_posts = UserLikePost::all();
        $user_like_comments = UserLikeComment::all();
        $user_id = user::where('username',$username)->first(['id']);
        $total_fav = UserLikePost::where('user_id',$user_id->id)->where('is_fav', 1)->count();
        $user_follower_count = follow::where('following_id',$user_id->id)->where('is_follow',1)->count();
        $user_following_count = follow::where('owner_id',$user_id->id)->where('is_follow',1)->count();
        $followers = follow::where('following_id',$user_id->id)->where('is_follow',1)->get();
        $is_follow = follow::where('following_id',$user_id->id)->first(['is_follow']);
<<<<<<< HEAD
        $posts_count = postcontent::where('user_id', $user_id)->count();
=======
        $posts_count = postcontent::where('user_id', Auth::user()->id)->count();
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6

        return view('profile')->with(array('users' => $users, 'collections' => $collections,
                                'posts' => $posts, 'username' => $username, 'comments' => $comments,
                                'follows' => $follows, 'user_like_posts' => $user_like_posts,
                                'user_like_comments' => $user_like_comments,
                                'total_fav' => $total_fav, 'user_following_count' => $user_following_count,
                                'user_follower_count' => $user_follower_count, 'followers' => $followers,
                                'is_follow' => $is_follow, 'posts_count' => $posts_count));
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
    public function update(Request $request)
    {
        $user = user::find($request->input('user_id'));
        $user->bio = $request->input('bio-description');
        $user->bio_link = $request->input('bio-link');
        $user->save();

        return $user->bio_link;
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

    public function follow(Request $request)
    {
        $follow_user = follow::where('owner_id',$request->owner_id)->where('following_id',$request->following_id);
        $count_follow = $follow_user->count();
        if ($count_follow == 0) {
            $follow = new follow;
            $follow->owner_id = $request->owner_id;
            $follow->following_id = $request->following_id;
            $follow->is_follow = 1;
            $follow->save();

            $following_count = follow::where('following_id', $request->following_id)->where('is_follow', 1)->count();
            $owner_following_count = follow::where('owner_id', $request->owner_id)->where('is_follow', 1)->count();
            return array($follow->is_follow, $following_count, $owner_following_count);
        } else {
            $owner = user::find($request->input('owner_id'));
            $following = user::find($request->input('following_id'));
            $followtoggle = $follow_user->first();
            if ($followtoggle->is_follow==0) {
              $followtoggle->is_follow = 1;
              $owner->save();
              $following->save();
            }
            else {
              $followtoggle->is_follow = 0;
              $owner->save();
              $following->save();
            }
            $followtoggle->save();
            $following_count = follow::where('following_id', $following->id)->where('is_follow', 1)->count();
            $owner_following_count = follow::where('owner_id', $owner->id)->where('is_follow', 1)->count();

            return array($followtoggle->is_follow, $following_count, $owner_following_count);
        }


    }

    public function follower($username)
    {
        // profile header
        $users = user::all();
        $collections = collection::all();
        $user_id = user::where('username',$username)->first(['id']);
        $total_fav = UserLikePost::where('user_id',$user_id->id)->where('is_fav', 1)->count();
        $user_follower_count = follow::where('following_id',$user_id->id)->where('is_follow',1)->count();
        $owner = follow::where('owner_id',$user_id->id)->where('is_follow',1);
        $user_following_count = $owner->count();
        $follows = follow::all();
        // end profile header
        $followings = $owner->orderBy('updated_at','desc')->get();
        $followers = follow::where('following_id',$user_id->id)->where('is_follow',1)->orderBy('updated_at','desc')->get();

        return view('follower')->with(array('users' => $users, 'collections' => $collections,
                                            'username' => $username,'total_fav' => $total_fav, 'user_following_count' => $user_following_count,
                                            'user_follower_count' => $user_follower_count, 'followers' => $followers,
                                            'user_id' => $user_id, 'follows' => $follows, 'followings' => $followings));
    }

    public function following($username)
    {
        // profile header
        $users = user::all();
        $collections = collection::all();
        $user_id = user::where('username',$username)->first(['id']);
        $userfav = UserLikePost::where('user_id',$user_id->id)->where('is_fav', 1);
        $total_fav = $userfav->count();
        $user_follower_count = follow::where('following_id',$user_id->id)->where('is_follow',1)->count();
        $owner = follow::where('owner_id',$user_id->id)->where('is_follow',1);
        $user_following_count = $owner->count();
        $follows = follow::all();
        // end profile header

        $followers = follow::where('following_id',$user_id->id)->where('is_follow',1)->orderBy('updated_at','desc')->get();
        $followings = $owner->orderBy('updated_at','desc')->get();

        return view('following')->with(array('users' => $users, 'collections' => $collections,
                                            'username' => $username,'total_fav' => $total_fav, 'user_following_count' => $user_following_count,
                                            'user_follower_count' => $user_follower_count,
                                            'user_id' => $user_id, 'follows' => $follows,
                                            'followings' => $followings));
    }


}
