<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\user;
use redirect;
use Storage;

class SettingAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = user::all();
        return view('settingaccount')->with('users', $user);
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
      // $regex = '/^(https?:\/\/)?([da-z\.-]+)\.([a-z]{2,6})(\/(\w|-)*)*\/?$/gi';
      // $this->validate($request, [
      //   'username' => [
      //     'required', 'max:20', 'min:6',
      //     Rule::unique('users')->ignore($request->input('user_id')),
      //   ],
      //   'email'=> [
      //     'required', 'email',
      //     Rule::unique('users')->ignore($request->input('user_id')),
      //   ],
      //   'display_name' => [
      //     'required', 'max:20', 'min:6',
      //     Rule::unique('users')->ignore($request->input('user_id')),
      //   ],
      //   'bio_link' => [
      //     'regex:' . $regex,
      //   ],
      // ]);

      $regex =  '/^(https?:\\/\\/)?'. // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'. // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))'. // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'. // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?'. // query string
                '(\\#[-a-z\\d_]*)?$/';

      $this->validate($request, [
        'username' => [
            'required', 'max:20', 'min:6',
            Rule::unique('users')->ignore($request->input('user_id')),
        ],
        'email'=> [
            'required', 'email',
            Rule::unique('users')->ignore($request->input('user_id')),
        ],
        'display_name' => [
<<<<<<< HEAD
            'required', 'max:20',
=======
            'required', 'max:20', 'min:6',
>>>>>>> be6a45744d638fd603b7a1682d6cb74d29190ca6
            Rule::unique('users')->ignore($request->input('user_id')),
        ],
        'bio_link' => [
            'regex:' . $regex,
          ],
      ]);

       if ($request->has('imageUpload-edit')) {
           //Get filename with the extension
           $filenamewithExt = $request->file('imageUpload-edit')->getClientOriginalName();
           //Get just filename
           $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
           //Get just ext
           $extension = $request->file('imageUpload-edit')->guessClientExtension();
           //FileName to store
           $fileNameToStore = time().'.'.$extension;
           //Upload Image
           $path = $request->file('imageUpload-edit')->storeAs('public/upload',$fileNameToStore);
            // Storage::disk('public')->put($path);
        } else {
          $fileNameToStore = $request->input('avatar');
        }
      //   // return $fileNameToStore;
        $user = user::find($request->user_id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->display_name = $request->display_name;
        $user->bio = $request->bio;
        $user->bio_link = $request->bio_link;
        $user->avatar = $fileNameToStore;
        $user->save();

        // return $user;
        return back()->with('message', 'Updated Success !');
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

    public function updateimage(Request $request)
    {
      if ($request->has('imageUpload')) {
          // Get filename with the extension
          $filenamewithExt = $request->file('imageUpload')->getClientOriginalName();
          //Get just filename
          $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
          //Get just ext
          $extension = $request->file('imageUpload')->guessClientExtension();
          //FileName to store
          $fileNameToStore = time().'.'.$extension;
          //Upload Image
          $path = $request->file('imageUpload')->storeAs('public/upload',$fileNameToStore);
           // Storage::disk('public')->put($path);
       } else {
         $fileNameToStore = $request->input('avatar');
       }

       $user = user::find($request->input('user_id'));
       $user->avatar = $fileNameToStore;
       $user->save();

       return back();
    }


}
