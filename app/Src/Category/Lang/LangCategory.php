<?php

namespace App\Src\Category\Lang;

use App\Core\PrimaryModel;
use App\Core\LocaleTrait;

/**
 * App\Src\Category\Lang\LangCategory
 *
 */
class LangCategory extends PrimaryModel
{
    public $table = 'langs_categories';

    protected $fillable = ['name_ar', 'name_en'];

    protected $localeStrings = ['name'];

    use LocaleTrait;
}
