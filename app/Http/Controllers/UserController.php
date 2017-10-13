<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MercurySeries\Flashy\Flashy;

class UserController extends Controller
{

    public function __construct() {

//        $this->middleware('isAdmin')->only('index', 'changeRights');
//        $this->middleware('hasRights')->only('show', 'edit', 'update', 'destroy', 'editPassword');

    }

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
        $reviews = Review::where('user_id',  $user->id)->get();
        if ($user->is_restaurant == 1) {
            $restaurants = Restaurant::where('user_id', $user->id)->get();
            return view('users.show', compact('user', 'reviews', 'restaurants'));
        }
        else {
            return view('users.show', compact('user', 'reviews'));
        }

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

        Flashy::success('Modification du profil effectuée');
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

        Flashy::success('Suppression effectuée');
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
