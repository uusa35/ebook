<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 6/16/15
 * Time: 11:27 PM
 */

namespace App\Src\Purchase;

use App\Core\AbstractRepository;

/**
 * App\Src\Purchase\PurchaseRepository
 *
 */
class PurchaseRepository extends AbstractRepository
{

    public function __construct(Purchase $purchase)
    {
        $this->model = $purchase;
    }

    public function createNewOrder($bookId, $authId)
    {
        return $this->model->create([
            'book_id' => $bookId,
            'user_id' => $authId,
            'stage'   => 'order'
        ]);
    }

    public function checkOrderExists($bookId, $authId)
    {
        return $this->model->where('book_id', '=', $bookId)->where('user_id', '=', $authId)->first();
    }

    public function deleteOrder($userId, $bookId)
    {
        return $this->model->where(['book_id' => $bookId, 'user_id' => $userId])->delete();
    }
}