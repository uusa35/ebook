<?php

namespace App\Jobs;

use App\Core\AbstractImageService;
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

    /*
    * Abstract CreateImages Job (Model , $request, FolderName, [FieldsName] , [Default thumbnail sizes] , [Default large sizes]
    * */


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

                    $update = $this->model->update([$this->folderName => strtolower($fileName)]);

                    if ($update) {

                        return true;

                    }

                    return false;

                } else {
                    abort(404, 'CreateImages error');
                }
            }

            abort(404, 'CreateImages after if');
        }

    }

}