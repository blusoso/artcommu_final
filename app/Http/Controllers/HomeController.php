<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\user;
use App\postcontent;
use App\collection;
use App\comment;
use App\UserLikePost;
use App\UserLikeComment;
use App\follow;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = user::all();
        $collections = collection::all();
        $posts = postcontent::orderBy('id', 'DESC')->get();
        $comments = comment::all();
        $user_like_posts = UserLikePost::all();
        $user_like_comments = UserLikeComment::all();
        $follows = follow::all();
<<<<<<< HEAD
        $is_follow = follow::where('owner_id', Auth::user()->id)->where('is_follow', 1)->orderBy('id', 'DESC');
        $is_follows = $is_follow->get();
        $is_fol = $is_follow->first();
        $is_follows_count =  postcontent::where('user_id', $is_fol->following_id)->count();
        $my_posts = postcontent::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
=======
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6
        return view('home')->with(array('users' => $users, 'collections' => $collections,
                                        'posts' => $posts, 'comments' => $comments,
                                        'user_like_posts' => $user_like_posts,
                                        'user_like_comments' => $user_like_comments,
<<<<<<< HEAD
                                        'follows' => $follows, 'is_follows' => $is_follows,
                                        'my_posts' => $my_posts, 'is_follows_count' => $is_follows_count));
=======
                                        'follows' => $follows));
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6
    }
}
