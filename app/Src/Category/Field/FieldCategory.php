<?php namespace App\Src\Category\Field;

use App\Core\AbstractModel;
use App\Core\LocaleTrait;

/**
 * App\Src\Category\Field\FieldCategory
 *
 */
class FieldCategory extends AbstractModel
{

    public $table = 'fields_categories';

    protected $fillable = ['name_ar', 'name_en'];

    protected $localeStrings = ['name'];

    use LocaleTrait;

}
