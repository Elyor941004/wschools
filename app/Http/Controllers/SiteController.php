<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use App\Models\Ingredients;
use App\Models\Directions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function index(){
        $foods = DB::table('foods')->where('tips', 'Foods')->paginate(12);
        return view('index', ['foods'=>$foods]);
    }

    public function desserts(){
        $desserts = DB::table('foods')->where('tips', 'Desserts')->paginate(12);
        return view('index', ['desserts'=>$desserts]);
    }

    public function cookies(){
        $cookies = DB::table('foods')->where('tips', 'Cookies')->paginate(12);
        return view('index', ['cookies'=>$cookies]);
    }

    public function about(){
        return view('about');
    }

    public function food($language, $id){
        $foods = Foods::find($id);
        $ingredients = DB::table('ingredients')->where('food_id', $id)->get();
        $directions = DB::table('directions')->where('food_id', $id)->get();
        return view('food', ['foods'=>$foods, 'ingredients'=>$ingredients, 'directions'=>$directions]);
    }

    public function contact(){
        return view('contact');
    }

}
