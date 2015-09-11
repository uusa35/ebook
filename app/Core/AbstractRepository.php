<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 8/29/15
 * Time: 5:56 PM
 */

namespace App\Core;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Core\AbstractRepository
 *
 */
class AbstractRepository extends Model
{

    public $model;


    public function  getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->where('id', '=', $id);
    }

}