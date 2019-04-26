<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Illuminate\Support\Facades\Hash;
use Auth;

class SettingPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = user::all();
        return view('settingpassword')->with('users', $user);
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
        $user = user::findOrFail($request->id);
        // $this->validate($request, [
        //     'password' => Auth::user()->password,
        //     'new_password' => 'confirmed|max:8|different:password',
        // ]);
        if (Hash::check($request->password, $user->password)) {
           $user->fill([
            'password' => Hash::make($request->new_password)
            ])->save();

            $request->session()->flash('success', 'Password changed');
            return redirect('settings/password');

        } else {
            $request->session()->flash('error', 'Password does not match');
            return redirect('settings/password');
        }
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
}
