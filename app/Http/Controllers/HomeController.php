<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	public function index()
	{
		//\Session::flush();
		return view('frontend.modules.book.index');
	}

}