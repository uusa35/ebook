<?php namespace App\Http\Controllers;

use App\Core\PrimaryController;
use App\Src\Book\BookRepository;
use App\Http\Requests;

class CategoryController extends PrimaryController
{
    public $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

        $allBooks = $this->bookRepository->getAllBooksForCategory($id);

        return view('frontend.modules.category.show', compact('allBooks'));
    }

}
