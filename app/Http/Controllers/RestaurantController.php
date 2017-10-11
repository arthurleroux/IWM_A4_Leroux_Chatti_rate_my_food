<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::take(10)->get();
        return view('restaurant.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'restaurant_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $restaurants = new Restaurant;

        $restaurants->user_id = Auth::user()->id;
        $restaurants->name = $request->name;
        $restaurants->description = $request->description;
        $restaurants->address = $request->address;
        $restaurants->city = $request->city;
        $restaurants->zip_code = $request->zip_code;

        $restaurants->save();

        if ($request->hasFile('restaurant_img')) {
            $picture = new Picture;

            $image = $request->file('restaurant_img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/restaurants_pictures/'. $restaurants->name .'_'. $restaurants->id);
            $image->move($destinationPath, $name);

            $picture->restaurant_id = $restaurants->id;
            $picture->path = $destinationPath;

            $picture->save();
        } else {
            dd('error');
        }

        return redirect()->route('restaurant.index');
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
}
