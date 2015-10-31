<?php

namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Jobs\CreateImages;
use App\Http\Requests;
use App\Src\Slider\Slider;
use Illuminate\Support\Facades\Cache;

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
        $slider = $this->slider->where('id', '=', $request->get('id'))->first();

        $slider->update([
            'caption' => $request->get('caption')
        ]);

        /*
      * Abstract CreateImages Job (Model , $request, FolderName, [FieldsName] , [Default thumbnail sizes] , [Default large sizes]
      * */

        if($request->get('url')) {

            $updateSlider = $this->dispatch(new CreateImages($slider, $request, 'slide', ['url'], ['',''], ['1500', '500']));;

        }

        if ($slider) {

            return redirect()->action('Backend\SlidersController@index')->with(['success' => trans('sucess.update')]);

        }

        return redirect()->action('Backend\SlidersController@index')->with(['error' => trans('error.update')]);

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
