<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Opening_time;
use App\Models\Picture;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use MercurySeries\Flashy\Flashy;

class RestaurantController extends Controller
{

    public function __construct() {
        $this->middleware('editRestaurant')->only('edit', 'update');
        $this->middleware('isRestaurant')->only('create', 'store');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::paginate(6);
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

        $input = $request->input();
        $input['user_id'] = Auth::user()->id;

        $restaurants->fill($input)->save();

        if ($request->hasFile('restaurant_img')) {
            $picture = new Picture;

            $image = $request->file('restaurant_img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/restaurants_pictures/'. $restaurants->name .'_'. $restaurants->id);

            $path = '/restaurants_pictures/'. $restaurants->name .'_'. $restaurants->id .'/'.$name;
            $image->move($destinationPath, $name);

            $picture->restaurant_id = $restaurants->id;
            $picture->path = $path;

            $picture->save();
        } else {
            Flashy::success('Vous devez ajouter une photo à votre restaurant', 'http://your-awesome-link.com');
            //dd('error');
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
        $restaurant = Restaurant::findOrFail($id);
        $pictures = Picture::where('restaurant_id', $id)->get();

        return view('restaurant.show', compact('restaurant', 'pictures'));
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
        $opening_days = Opening_time::where('restaurant_id', $id)->get();
        $pictures = Picture::where('restaurant_id', $restaurant->id)->get();

        return view('restaurant.edit', compact('restaurant', 'days', 'pictures', 'opening_days'));
    }

    public function edit_opening_time($request, $id)
    {
        $count = Opening_time::where('restaurant_id', $id)->count();

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
            foreach ($times as $time) {
                Opening_time::where('restaurant_id', $id)->where('day_id', $time['day_id'])->update($time);
            }
        } else {
            $opening_time = new Opening_time;

            $opening_time->insert($times);
        };

        return true;
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

        $restaurants = Restaurant::find($id);

        $input = $request->input();
        $input['user_id'] = Auth::user()->id;

        $restaurants->fill($input)->save();

        $this->edit_opening_time($request, $restaurants->id);

        Flashy::success('Modifications enregistrées avec succès', 'http://your-awesome-link.com');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_picture(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);

        //get the base-64 from data
        $base64_str = substr($request->image, strpos($request->image, ",") + 1);

        //decode base64 string
        $image = base64_decode($base64_str);
        $picture_name = 'restaurant_' . $id . '_' . time() . '.png';
        $destinationPath = public_path('restaurants_pictures/' . $restaurant->name . '_' . $id);
        $path = public_path('restaurants_pictures/' . $restaurant->name . '_' . $id . '/' . $picture_name);

        if (File::isDirectory($destinationPath)) {
            Image::make($image)->save($path);
        } else {
            File::makeDirectory($destinationPath, 0777, true, true);
            Image::make($image)->save($path);
        }

        $picture = new Picture;

        $picture->restaurant_id = $restaurant->id;
        $picture->path = 'restaurants_pictures/' . $restaurant->name . '_' . $id . '/' . $picture_name;

        $picture->save();

        if ($image) {
            return response()->json([
                'status' => 200,
                'response' => 'Photo enregistrée avec succès'
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'response' => 'Erreur lors de l\'enregistration de la photo'
            ]);
        }
    }

    public function delete_picture($id)
    {
        $picture = Picture::findOrFail($id);

        $picture->delete();

        Flashy::success('Photo supprimée avec succès', 'http://your-awesome-link.com');

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
        //
    }
}
