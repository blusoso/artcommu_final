<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\postcontent;
use App\image;
use App\post_has_collection;
use App\UserLikePost;
use App\collection;

class PostContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $image = new image;
        $post = new postcontent;
        $post->user_id = $request->input('user_id');
        $post->description = $request->input('status');
        $files = $request->file('images');

        if($request->hasFile('images'))
        {
            foreach ($files as $file) {
              $filenamewithExt = $file->getClientOriginalName();
              $path = $file->storeAs('public/uploadpost',$filenamewithExt);
              $post->img = $filenamewithExt;
              $post->save();
            }
        }

        return back();
    }

    public function delete(Request $request)
    {
        $post = postcontent::find($request->input('post_id'));
        $post->delete();

        $post_has_collection = post_has_collection::where('post_id', $request->input('post_id'));
        $post_has_collection->delete();

        $user_like_post = UserLikePost::where('post_id', $request->input('post_id'))->delete();
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
        $post = postcontent::find($request->input('post_id'));
        // return $post;
        if ($post->is_fav==0) {
          $post->is_fav = 1;
        }
        else {
          $post->is_fav = 0;
        }
        $post->save();
        return $post->is_fav;
        // return $post->is_fav;
    }
    public function addtocollection(Request $request)
    {
        $postincollection = post_has_collection::where('post_id', $request->post_id)->where('collection_id', $request->collection_id);
        $count_postincollection = $postincollection->count();
        if ($count_postincollection == 0) {
          $post_has_collection = new post_has_collection;
          $post_has_collection->post_id = $request->input('post_id');
          $post_has_collection->collection_id = $request->input('collection_id');
          $post_has_collection->save();

          $collection = collection::find($request->input('collection_id'));
          $collection->updated_at = $post_has_collection->updated_at;
          $collection->save();
          $update_at = [$post_has_collection->updated_at,$collection->updated_at];
        } else {
          return 'This post save in the collection already';
        }
    }

    public function favpost(Request $request)
    {
        $like_post = UserLikePost::where('user_id',$request->user_id)->where('post_id',$request->post_id);
        $count_post = $like_post->count();
        $post = postcontent::find($request->input('post_id'));
      if ($count_post > 0) {
        $favposttoggle = $like_post->first();
        if ($favposttoggle->is_fav==0) {
          $favposttoggle->is_fav = 1;
          $post->save();
        }
        else {
          $favposttoggle->is_fav = 0;
          $post->save();
        }
        $favposttoggle->save();
        $fav_count = UserLikePost::where('post_id', $post->id)->where('is_fav', 1)->count();
        $toggle = array("is_fav" => $favposttoggle->is_fav, "fav_count" => $fav_count);
        return Response()->json($toggle);
      }else{
        $favpost = new UserLikePost;
        $favpost->user_id = $request->input('user_id');
        $favpost->post_id = $request->input('post_id');
        $favpost->is_fav = 1;
        $favpost->save();

        $post->save();
        $fav_count = $like_post->count();
        $toggle = array("is_fav" => $favpost->is_fav, "fav_count" => $fav_count);
        return Response()->json($toggle);
      }
    }
}
