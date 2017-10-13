<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Opening_time;
use App\Models\Picture;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use MercurySeries\Flashy\Flashy;

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
        $messages = [
            'restaurant_img.required' => 'La photo du restaurant est obligatoire',
            'restaurant_img.mimes' => 'Les formats supportés sont : JPEG, PNG, et JPG',
            'restaurant_img.max' => 'Le poids de l\'image doit être inférieur à 2 Mo',
            'name.require' => 'Le nom du restaurant est obligatoire',
            'name.max' => 'Le nom est trop long',
            'description.required' => 'La description du restaurant est obligatoire',
            'description.max' => 'La desciption est trop longue',
            'address.required' => 'L\'adresse est obligatoire',
            'city.required' => 'La ville est obligatoire',
            'zip_code.required' => 'Le code postal est obligatoire',
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'restaurant_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'name' => 'required|max:255',
                'description' => 'required|max:500',
                'address' => 'required',
                'city' => 'required',
                'zip_code' => 'required',
            ],
            $messages
        );

        if ($validator->fails()) {
            Flashy::error("Une erreur s'est produite", 'http://your-awesome-link.com');

            return back()->withErrors($validator)->withInput();
        }

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

        Flashy::success('Restaurant ajouté avec succès', 'http://your-awesome-link.com');
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
        $restaurant = Restaurant::find($id);
        $days = Day::All();

        return view('restaurant.edit', compact('restaurant', 'days'));
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
        //dd($request->all());
        $messages = [
            'name.require' => 'Le nom du restaurant est obligatoire',
            'name.max' => 'Le nom est trop long',
            'description.required' => 'La description du restaurant est obligatoire',
            'description.max' => 'La desciption est trop longue',
            'address.required' => 'L\'adresse est obligatoire',
            'city.required' => 'La ville est obligatoire',
            'zip_code.required' => 'Le code postal est obligatoire',
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'description' => 'required|max:500',
                'address' => 'required',
                'city' => 'required',
                'zip_code' => 'required',
            ],
            $messages
        );

        if ($validator->fails()) {
            Flashy::error("Une erreur s'est produite", 'http://your-awesome-link.com');

            return back()->withErrors($validator)->withInput();
        }

        $restaurants = new Restaurant;

        $restaurants->user_id = Auth::user()->id;
        $restaurants->name = $request->name;
        $restaurants->description = $request->description;
        $restaurants->address = $request->address;
        $restaurants->city = $request->city;
        $restaurants->zip_code = $request->zip_code;

        $restaurants->save();

        $count = Opening_time::where('restaurant_id', $id)->count();
        //dd($count);
        $times = [
            [
                'restaurant_id' => $id,
                'day_id' => $request->lundi_id,
                'is_open' => $request->lundi ? true : false,
                'open_time' => $request->lundi_start_time,
                'close_time' => $request->lundi_end_time,
            ],
            [
                'restaurant_id' => $id,
                'day_id' => $request->mardi_id,
                'is_open' => $request->mardi ? true : false,
                'open_time' => $request->mardi_start_time,
                'close_time' => $request->mardi_end_time,
            ],
            [
                'restaurant_id' => $id,
                'day_id' => $request->mercredi_id,
                'is_open' => $request->mercredi ? true : false,
                'open_time' => $request->mercredi_start_time,
                'close_time' => $request->mercredi_end_time,
            ],
            [
                'restaurant_id' => $id,
                'day_id' => $request->jeudi_id,
                'is_open' => $request->jeudi ? true : false,
                'open_time' => $request->jeudi_start_time,
                'close_time' => $request->jeudi_end_time,
            ],
            [
                'restaurant_id' => $id,
                'day_id' => $request->vendredi_id,
                'is_open' => $request->vendredi ? true : false,
                'open_time' => $request->vendredi_start_time,
                'close_time' => $request->vendredi_end_time,
            ],
            [
                'restaurant_id' => $id,
                'day_id' => $request->samedi_id,
                'is_open' => $request->samedi ? true : false,
                'open_time' => $request->samedi_start_time,
                'close_time' => $request->samedi_end_time,
            ],
            [
                'restaurant_id' => $id,
                'day_id' => $request->dimanche_id,
                'is_open' => $request->dimanche ? true : false,
                'open_time' => $request->dimanche_start_time,
                'close_time' => $request->dimanche_end_time,
            ]
        ];

        if ($count > 0) {
            //Opening_time::where('restaurant_id', $id)->update($times);

            foreach ($times as $time) {
                // dd($time["day_id"]);
                Opening_time::where('restaurant_id', $id)->where('day_id', $time['day_id'])->update($time);
            }
        } else {
            $opening_time = new Opening_time;

            $opening_time->insert($times);
        };

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_picture(Request $request)
    {
        $response = array(
            'msg' => 'Setting created successfully'
        );
        return Response::json($response);
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
