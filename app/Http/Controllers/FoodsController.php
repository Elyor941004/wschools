<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodsRequest;
use App\Models\Directions;
use App\Models\Foods;
use App\Models\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FoodsController extends Controller
{
    public $type_foods = ['Foods', 'Salads', 'Desserts', 'Cookies'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = DB::table('Foods')->paginate(10);
        return view('admin.foods.index', ['models' => $models]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_foods = $this->type_foods;
        $models = Foods::all();
        return view('admin.foods.create', ['models' => $models, 'type_foods' => $type_foods]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodsRequest $request)
    {
        $models = new Foods();
        $models->name = $request->name;
        $models->text = $request->text;
        $models->time = $request->times;
        $models->tips = $request->tips;
        $images = $request->file('image')->store('public');
        $image = explode('/', $images);
        $models->image = array_pop($image);
        $models->save();
        if (is_array($request->ingredient)) {
            foreach ($request->ingredient as $ingredient) {
                $ingredients = new Ingredients();
                if(isset($ingredient)){
                    $ingredients->name = $ingredient;
                    $ingredients->food_id = $models->id;
                    $ingredients->save();
                }
            }
        }else{
            $ingredients = new Ingredients();
            if(isset($ingredient)) {
                $ingredients->name = $request->ingredient;
                $ingredients->save();
            }
        }
        if (is_array($request->directions)) {
            foreach ($request->directions as $direction) {
                $model = new Directions();
                if(isset($direction)){
                    $model->text = $direction;
                    $model->food_id = $models->id;
                    $model->save();
                }
            }
        }else{
            $model = new Directions();
            if(isset($model)) {
                $model->text = $request->directions;
                $model->food_id = $models->id;
                $model->save();
            }
        }
        return redirect()->route('foods.index');
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
        $model = Foods::find($id);
        $type_foods = $this->type_foods;
        $ingredients = DB::table('Ingredients')->where('food_id', $id)->get();
        $directions = DB::table('Directions')->where('food_id', $id)->get();
        return view('admin.foods.update', ['model' => $model, 'ingredients' => $ingredients,
            'directions' => $directions, 'type_foods' => $type_foods]);
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
        $models = Foods::find($id);
        $models->name = $request->name;
        $models->text = $request->text;
        $models->time = $request->times;
        $models->tips = $request->tips;
        if (isset($request->image)){
            Storage::delete('public/'.$models->image);
            $images = $request->file('image')->store('public');
            $image = explode('/', $images);
            $models->image = array_pop($image);
        }
        $models->save();
        if (is_array($request->ingredient)) {
            DB::table('Ingredients')->where('food_id', $id)->delete();
            foreach ($request->ingredient as $ingredient) {
                $ingredients = new Ingredients();
                if(isset($ingredient)){
                    $ingredients->name = $ingredient;
                    $ingredients->food_id = $models->id;
                    $ingredients->save();
                }
            }
        }else{
            $ingredients = new Ingredients();
            DB::table('Ingredients')->where('food_id', $id)->delete();
            if(isset($ingredient)) {
                $ingredients->name = $request->ingredient;
                $ingredients->save();
            }
        }
        if (is_array($request->directions)) {
            DB::table('Directions')->where('food_id', $id)->delete();
            foreach ($request->directions as $direction) {
                $model = new Directions();
                if(isset($direction)){
                    $model->text = $direction;
                    $model->food_id = $models->id;
                    $model->save();
                }
            }
        }else{
            $model = new Directions();
            DB::table('Directions')->where('food_id', $id)->delete();
            if(isset($model)) {
                $model->text = $request->directions;
                $model->food_id = $models->id;
                $model->save();
            }
        }

        return redirect()->route('foods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Foods::find($id);
        if ($model->image){
            Storage::delete('public/'.$model->image);
        }
        $model->delete();
        DB::table('Ingredients')->where('food_id', $id)->delete();
        DB::table('Directions')->where('food_id', $id)->delete();
        return redirect()->route('foods.index');
    }
}
