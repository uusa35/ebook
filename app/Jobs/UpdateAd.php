<?php

namespace App\Jobs;

use App\Src\Advertisement\Advertisement;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class UpdateAd extends Job implements SelfHandling
{

    public $request;
    public $ad;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Advertisement $ad,$request)
    {
        $this->ad = $ad;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Image $image)
    {
        $fileName = $this->request->file('url')->getClientOriginalName();

        $fileName = Str::random(5) . '' . $fileName;

        $realPath = $this->request->file('url')->getRealPath();

        $image->make($realPath)->resize('350',

            '150')->save(public_path('/img/ads/' . $fileName));

        $this->ad->update(['url' => '/img/ads/'.$fileName]);

        return $this->ad->save();
    }
}
