<?php namespace Usama\CommentPack\Facade;
use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 12/22/15
 * Time: 9:18 AM
 */
class CommentPack extends  Facade
{

    public static function getFacadeAccessor()
    {
        return 'CommentPack';
    }
}