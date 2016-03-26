<?php

namespace App\Http\Controllers\Backend;

use App\Core\PrimaryController;
use App\Http\Requests\CreateCategory;
use App\Src\Category\Field\FieldCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class FieldCategoriesController extends PrimaryController
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
        $this->getPageTitle('category.index');

        $this->authorize('authorizeAccess','categories');

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
        $this->getPageTitle('category.create');

        $this->authorize('authorizeAccess','category_create');

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
        $this->authorize('authorizeAccess','category_create');

        $this->fieldCategory->create($request->except('_token'));

        $fieldsCategories = $this->fieldCategory->all();

        Cache::forget('fieldsCategories');

        Cache::forever('fieldsCategories', $fieldsCategories);

        return redirect()->action('Backend\FieldCategoriesController@index')->with('success', trans('messages.success.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $this->getPageTitle('category.edit');

        $this->authorize('authorizeAccess','category_edit');

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

        $this->authorize('authorizeAccess','category_edit');

        $this->fieldCategory->where('id', '=', $id)->update([
            'name_ar' => $request->input('name_ar'),
            'name_en' => $request->input('name_en')
        ]);

        $fieldsCategories = $this->fieldCategory->all();

        Cache::forget('fieldsCategories');

        Cache::forever('fieldsCategories', $fieldsCategories);

        return redirect()->back()->with('success', trans('messages.success.updated'));
    }

}
