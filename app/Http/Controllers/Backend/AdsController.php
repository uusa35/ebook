<?php

namespace App\Http\Controllers\Backend;

use App\Core\AbstractController;
use App\Jobs\CreateImages;
use App\Src\Advertisement\Advertisement;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdsController extends AbstractController
{
    public $ad;

    public function __construct(Advertisement $ad)
    {
        $this->ad = $ad;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->getPageTitle('ad.index');

        $this->authorize('index',Session::get('module'));

        $allAdsStored = $this->ad->take(2)->get();

        return view('backend.modules.ad.index', compact('allAdsStored'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->getPageTitle('ad.create');

        return view('backend.modules.ad.create');
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
        $this->getPageTitle('ad.edit');

        $this->authorize('checkAssignedPermission','ad_edit');

        $ad = $this->ad->where('id', '=', $id)->first();

        return view('backend.modules.ad.edit', compact('id', 'ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Requests\EditAd $request)
    {
        $this->authorize('checkAssignedPermission','ad_edit');

        $ad = $this->ad->where('id', '=', $request->get('id'))->first();

        /*
      * Abstract CreateImages Job (Model , $request, FolderName, [FieldsName] , [Default thumbnail sizes] , [Default large sizes]
      * */
        $updateAd = $this->dispatch(new CreateImages($ad, $request, 'ads', ['ads'], ['200', '50'], ['500', '120']));;

        if ($updateAd) {

            $allAds = $this->ad->all();

            \Cache::rememberForever('allAds',$allAds);

            return redirect()->action('Backend\AdsController@index')->with(['success' => trans('sucess.ad-updated')]);

        }

        return redirect()->action('Backend\AdsController@index')->with(['error' => trans('sucess.ad-not-updated')]);

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
