<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Unit;
use App\Models\Upload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $products = Product::all(['id', 'name', 'status']);
	
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
	    return view('products.index', compact('products','heads','config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $categories = Category::all(['id','name']);
	    $units = Unit::all(['id','name']);
	    
	    return view('products.create',compact('categories','units'));
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
		    'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/|unique:products',
		    'product_code' => 'required',		    
		    'category_id' => 'required',
		    'unit_id' => 'required',
		    'price_buy' => 'required',
		    'price_sale' => 'required',
		    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	    ]);
	
	    // Upload File
	    if ($request->hasFile('image')) {
		    $upload = upload($request->image, [
			    'directory'=>'products',
			    'visitable'	=> true
		    ]);
	    }
	
	    $product = new Product();
	    $product->name = $request->name;
	    $product->product_code = $request->product_code;	    
	    $product->slug = Str::slug($request->name);	    
	    $product->category_id = $request->category_id;
	    $product->unit_id = $request->unit_id;
	    $product->price_buy = $request->price_buy;
	    $product->price_sale = $request->price_sale;
	    $product->status = !!$request->status??false;
	    $product->is_product = !!$request->is_product??false;
	    $product->is_material = !!$request->is_material??false;
	    $product->save();
	
	
	    if (isset($upload->id) && isset($product->id)) {
		    $productImages = New ProductImages();
		    $productImages->product_id = $product->id;
		    $productImages->upload_id = $upload->id;
		    $productImages->save();
	    }
	    
	    return redirect(route('products.index'))->with('message', 'Item foi atualizado!');
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
		$product = Product::findOrFail($id);
		
	    $categories = Category::all(['id','name']);
	    $units = Unit::all(['id','name']);
	
	    return view('products.edit',compact('categories','units','product'));
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
