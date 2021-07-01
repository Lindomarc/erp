<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\Category;
	use Illuminate\Http\Request;
	use Illuminate\Support\Str;
	
	class CategoriesController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			$categories = Category::all(['id', 'name', 'status']);
			
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
			return view('category.index', compact('categories','heads','config'));
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('category.create');
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
			
			$request->validate([
				'name' => 'required|min:3|max:80|unique:categories'
			]);
			
			$category = new Category();
			$category->name = $request->name;
			$category->slug = Str::slug($request->name);
			$category->status = true;
			$category->save();
			
			return redirect()->back()->with('message', __('Category Created Successfully'));
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param int $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id)
		{
			//
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param int $id
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
			$category = Category::findOrFail($id);
			
			return view('category.edit',compact('category'));
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param int $id
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, $id)
		{
			$request->validate([
				'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
			]);
			
			$category = Category::findOrFail($id);
			$category->name = $request->name;
			$category->slug = Str::slug($request->name);
			$category->save();
			
			return redirect()->back()->with('message', 'Category Updated Successfully');
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param int $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
			$category = Category::find($id);
			$category->delete();
			return redirect()->back();
			
		}
	}
