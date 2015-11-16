<?php

namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Jobs\CreateImages;
use App\Http\Requests;
use App\Src\Slider\Slider;

class SlidersController extends AbstractController
{
    public $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->getPageTitle('slider.index');

        $this->authorize('index', 'Slider');

        $allSlides = $this->slider->get();

        return view('backend.modules.slider.index', compact('allSlides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->getPageTitle('slider.create');

        return view('backend.modules.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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
        $this->getPageTitle('slider.edit');

        $this->authorize('checkAssignedPermission', 'slider_edit');

        $slide = $this->slider->where('id', '=', $id)->first();

        return view('backend.modules.slider.edit', compact('id', 'slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Requests\EditSlide $request)
    {
        $this->authorize('checkAssignedPermission', 'slider_edit');

        $slider = $this->slider->where('id', '=', $request->get('id'))->first();

        $slider->update([
            'caption' => $request->get('caption')
        ]);

        /*
      * Abstract CreateImages Job (Model , $request, FolderName, [FieldsName] , [Default thumbnail sizes] , [Default large sizes]
      * */

        if ($request->hasFile('slide')) {

            $this->dispatch(new CreateImages($slider, $request, 'slide', ['slide'], ['', ''], ['1500', '500']));

            $sliders = $this->slider->all();

            \Cache::rememberForever('sliders', $sliders);

        }

        if ($slider) {

            return redirect()->action('Backend\SlidersController@index')->with(['success' => trans('messages.sucess.update')]);

        }

        return redirect()->action('Backend\SlidersController@index')->with(['error' => trans('messages.error.update')]);

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
