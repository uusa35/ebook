<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 6/4/15
 * Time: 7:27 AM
 */
namespace App\Src\Book;

use Illuminate\Support\Facades\Mail;

trait BookHelpers
{

    /**
     * @return string
     * Generate PDF file Name for the Book
     */
    private function generateFileName()
    {
        return md5(uniqid(mt_rand(10, 1202020), true)) . '.pdf';
    }

    public function NotifyChangeStageOrder($data = [])
    {

        Mail::later(2, 'emails.order_notification', ['data' => $data], function ($message) use ($data) {

            $message->from('Admin@e-boook.com');

            $message->subject('Order Notification - ' . $data['stage'] . ' Book : ' . $data['book']->title_en . '-' . $data['book']->title_ar);

            // will be replaced with the auth user who made the order
            $message->to('uusa35@gmail.com');
            /*->cc();*/
        });
    }

    public function createBookSerial($userId,$bookId) {

        return $serial = $userId.'-'.date('Y-m-d').'-'.$bookId;


    }


}