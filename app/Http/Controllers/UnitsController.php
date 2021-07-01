<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $units = Unit::all('id','name','status');
	    $heads = [
		    'ID',
		    'Nome',
		    'status',
		    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
	    ];
	
	    $config = [
		    'order' => [[1, 'asc']],
		    'columns' => [null, null, null, ['orderable' => false]],
	    ];
	    return view('units.index', compact('units','heads','config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	
	
	    $request->validate([
		    'name' => 'required|min:3|max:80|unique:categories'
	    ]);
	
	    $unit = new Unit();
	    $unit->name = $request->name;
	    $unit->slug = Str::slug($request->name);
	    $unit->status = true;
	    $unit->save();
	
	    return redirect(route('units.index'))->with('message', __('Item foi criado!'));
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
	    $request->validate([
		    'name' => 'required|min:2|unique:units|regex:/^[a-zA-Z ]+$/',
	    ]);
	    $unit = new Unit();
	    $unit->name = $request->name;
	    $unit->slug = Str::slug($request->name);
	    $unit->status = 1;
	    $unit->save();
	
	    return redirect()->back()->with('message', 'Item foi atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$unit = Unit::find($id);
	    $unit->delete();
	    return redirect()->back();
	
    }
}
