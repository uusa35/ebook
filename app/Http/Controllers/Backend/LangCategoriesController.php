<?php

namespace App\Http\Controllers\Backend;

use App\Core\PrimaryController;
use App\Http\Requests\CreateCategory;
use App\Src\Category\Lang\LangCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LangCategoriesController extends PrimaryController
{
    public $langCategory;

    public function __construct(LangCategory $langCategory)
    {
        $this->langCategory = $langCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->authorize('authorizeAccess','categories');

        $this->getPageTitle('category.index');

        $categories = $this->langCategory->all();

        return view('backend.modules.category.lang.index', ['categories' => $categories]);
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

        return view('backend.modules.category.lang.create');
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

        $this->langCategory->create($request->except('_token'));
        
        return redirect()->action('Backend\LangCategoriesController@index')->with('success', trans('messages.success.created'));
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

        $category = $this->langCategory->find($id);

        return view('backend.modules.category.lang.edit', ['category' => $category]);
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

        $this->langCategory->where('id', '=', $id)->update([
            'name_ar' => $request->input('name_ar'),
            'name_en' => $request->input('name_en')
        ]);

        return redirect()->back()->with('success', trans('messages.success.updated'));
    }

}
