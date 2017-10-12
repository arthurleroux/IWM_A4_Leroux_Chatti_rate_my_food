<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MercurySeries\Flashy\Flashy;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view("users.index", compact('users'));
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
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = User::findOrFail($id);
        $input = $request->input();
        $user->fill($input)->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }

    public function changeRights(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->is_admin = $request->rights;
        $user->save();


        Flashy::success('Modification des droits effectuée');
        return redirect()->back();
    }

    public function editPassword(Request $request, $id) {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::findOrFail($id);
        $input = $request->input();
        $input['password'] = Hash::make($request->password);
        $user->fill($input)->save();

        Flashy::success('Modification du mot de passe effectuée');
        return view('users.show', compact('user'));
    }
}
