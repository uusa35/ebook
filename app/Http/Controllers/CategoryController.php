<?php namespace App\Http\Controllers;

use App\Core\LocaleTrait;
use App\Core\PrimaryController;
use App\Src\Book\BookRepository;
use App\Http\Requests;
use App\Src\Category\Field\FieldCategory;

class CategoryController extends PrimaryController
{
    use LocaleTrait;
    public $bookRepository;
    public $category;

    public function __construct(BookRepository $bookRepository, FieldCategory $fieldCategory)
    {
        $this->bookRepository = $bookRepository;
        $this->category = $fieldCategory;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

        $categoryName = $this->category->where('id',$id)->first();

        $allBooks = $this->bookRepository->getAllBooksForCategory($id);

        return view('frontend.modules.category.show', compact('allBooks','categoryName'));
    }

}
