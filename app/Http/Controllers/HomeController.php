<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		$request->session()->flash('flash.banner', 'Yay it works!');
		$request->session()->flash('flash.bannerStyle', 'success');
		
		return view('home.index');
    }
}
