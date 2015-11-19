<?php

namespace App\Src\Slider;

use App\Core\AbstractModel;

/**
 * App\Src\Advertisement\Advertisement
 *
 */
class Slider extends AbstractModel
{

    public $table = 'sliders';

    public $fillable = ['slide','caption','url'];
}
