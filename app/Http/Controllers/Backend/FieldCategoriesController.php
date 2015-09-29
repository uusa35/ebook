<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategory;
use App\Src\Category\Field\FieldCategory;
use Illuminate\Http\Request;

class FieldCategoriesController extends Controller
{
    public $fieldCategory;

    public function __construct(FieldCategory $fieldCategory)
    {
        $this->fieldCategory = $fieldCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->fieldCategory->all();

        return view('backend.modules.category.field.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.modules.category.field.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategory $request
     * @return Response
     */
    public function store(CreateCategory $request)
    {
        $this->fieldCategory->create($request->except('_token'));

        return redirect()->back()->with('success', trans('word.create-success-category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->fieldCategory->find($id);

        return view('backend.modules.category.field.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->fieldCategory->where('id', '=', $id)->update([
            'name_ar' => $request->input('name_ar'),
            'name_en' => $request->input('name_en')
        ]);

        return redirect()->back()->with('success', trans('word.create-category-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
