<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return view('frontend.modules.book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show()
    {

        return view('frontend.modules.book.show');
    }


}
