<?php

namespace App\Src\Category\Lang;

use App\Core\AbstractModel;
use App\Core\LocaleTrait;

/**
 * App\Src\Category\Lang\LangCategory
 *
 */
class LangCategory extends AbstractModel
{
    public $table = 'langs_categories';

    protected $fillable = ['name_ar', 'name_en'];

    protected $localeStrings = ['name'];

    use LocaleTrait;
}
