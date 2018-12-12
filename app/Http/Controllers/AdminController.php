<?php

namespace App\Http\Controllers;

use App\Classes\Character;
use App\Classes\DataProvider;
use App\Http\Requests\NewCharacter;
use App\Http\Requests\ThingRequest;
use Illuminate\Http\Request;
use DB;
use App\Thing;
use App\Color;

class AdminController extends Controller
{
    public function index()
    {
        $things = Thing::all();
        $colors = Color::all();
        return view('admin')->with('things', $things)->with('colors', $colors);
    }

    public function del(Request $request)
    {
        DB::delete('delete from things where id = :id', ['id' => $request->delete]);
        return redirect('admin');
    }

    public function add(ThingRequest $request)
    {
        try
        {
            $newthing = new Thing();
            $newthing->name = $request->newname;
            $newthing->nbBricks = $request->newbricks;
            $newthing->color_id = $request->newcolor;
            $newthing->save();
        } catch (\Exception $e)
        {
            $request->session()->flash('flashmessage','existe déjà');
        }
        return redirect('admin');
    }
}
