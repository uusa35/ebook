<?php

namespace App\Src\Slider;

use App\Core\PrimaryModel;

/**
 * App\Src\Advertisement\Advertisement
 *
 */
class Slider extends PrimaryModel
{

    public $table = 'sliders';

    public $fillable = ['slide','caption','url'];
}
