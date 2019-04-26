<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use App\postcontent;
use App\user;
use App\UserLikeComment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $comment = new comment;
        $comment->comment = $request->input('comment');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = $request->input('user_id');
        $comment->save();

        return $comment;
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
    public function delete(Request $request)
    {
        $comment = comment::find($request->input('comment_id'));
        $comment->delete();

        $post = postcontent::find($request->input('post_id'));
        $post->save();
    }

    public function fav(Request $request)
    {
        $like_comment = UserLikeComment::where('user_id',$request->user_id)->where('comment_id',$request->comment_id);
        $count_comment = $like_comment->count();
        $comment = comment::find($request->input('comment_id'));
        if ($count_comment > 0) {
          $favcommenttoggle = $like_comment->first();
          if ($favcommenttoggle->is_fav==0) {
            $favcommenttoggle->is_fav = 1;
            $comment->save();
          }
          else {
            $favcommenttoggle->is_fav = 0;
            $comment->save();
          }
          $favcommenttoggle->save();
          $fav_comment_count = UserLikeComment::where('comment_id', $comment->id)->where('is_fav', 1)->count();
          $toggle = array("is_fav" => $favcommenttoggle->is_fav, "fav_count" => $fav_comment_count);
          return $toggle;
        }else{
          $favcomment = new UserLikeComment;
          $favcomment->user_id = $request->input('user_id');
          $favcomment->comment_id = $request->input('comment_id');
          $favcomment->is_fav = 1;
          $favcomment->save();

          $fav_comment_count = UserLikeComment::where('comment_id', $comment->id)->where('is_fav', 1)->count();
          $toggle = array("is_fav" => $favcomment->is_fav , "fav_count" => $fav_comment_count);
          return $toggle;
        }
    }
}
