<?php

namespace App\Http\Controllers\Backend;

use App\Jobs\UpdateAd;
use App\Src\Advertisement\Advertisement;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public $ad;
    public function __construct(Advertisement $ad) {
        $this->ad = $ad;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

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
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ad = $this->ad->where('id','=',$id)->first();
        return view('backend.modules.ad.edit',['id'=>$id,'ad'=> $ad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\EditAd $request)
    {
        $ad = $this->ad->where('id','=',$request->get('id'))->first();

        $updateAd = $this->dispatch(new UpdateAd($ad,$request));

        if($updateAd) {

            return redirect()->back()->with(['success'=>trans('sucess.ad-updated')]);

        }

        return redirect()->back()->with(['error'=>trans('sucess.ad-not-updated')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
