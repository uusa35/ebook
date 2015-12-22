<?php namespace Usama\CommentPack\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 12/22/15
 * Time: 9:00 AM
 */
class CommentPackController extends Controller
{

    public function index () {
        return view('CommentPack::index');
    }
}