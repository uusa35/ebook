<?php

namespace App\Jobs;

use App\Core\AbstractImageService;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateImages extends Job implements SelfHandling
{

    public $model;
    protected $request;
    public $fieldNames;
    public $imageService;
    public $folderName;
    public $thumbSizes;
    public $largeSizes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Model $model,
        Request $request,
        $folderName,
        $fieldNames,
        $thumbSizes = ['100', '100'],
        $largeSizes = ['250', '250']
    ) {
        $this->model = $model;
        $this->request = $request;
        $this->fieldNames = $fieldNames;
        $this->folderName = $folderName;
        $this->thumbSizes = $thumbSizes;
        $this->largeSizes = $largeSizes;
        $this->imageService = new AbstractImageService();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->fieldNames as $currentRequestImage) {

            if ($this->request->hasFile($currentRequestImage)) {

                $fileName = $this->imageService->CreateImage($this->request->file($currentRequestImage),
                    $this->folderName, $this->thumbSizes,
                    $this->largeSizes);

                // folderName is the Coloumn Table Name :)
                if ($fileName) {

                    $this->model->update([$this->folderName => strtolower($fileName)]);

                    $this->model->save();
                }
                else {
                    dd('pics create image job error');
                }
            }
        }

    }

}