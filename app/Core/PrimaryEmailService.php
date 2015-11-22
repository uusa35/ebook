<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 11/21/15
 * Time: 5:35 PM
 */

namespace App\Core;

use Illuminate\Support\Facades\Mail;

trait PrimaryEmailService
{


    public function sendEmailContactus($data)
    {

        return Mail::send('emails.contactus', ['data' => $data], function ($message) use ($data) {

            $message->from('uusa35@gmail.com', 'Contact Us');
            $message->subject('E-Boook.com | Contact Us | ' . $data['subject']);
            $message->priority('high');
            $message->to(\Cache::get('contactusInfo')->email);
            $message->to('uusa35@gmail.com');

        });

    }

    public function sendEmailForDraftedChapter($data, $book)
    {
        Mail::later(1, 'emails._new_drafted_chapter', ['data' => $data], function ($message) use ($book) {
            $message->from(\Cache::get('contactusInfo')->email, 'E-boook.com');
            $message->subject('E-Boook.com | New Drafted Book | ' . $book->title);
            $message->priority('high');
            $message->to(\Cache::get('contactusInfo')->email);
            $message->cc('uusa35@gmail.com');
        });
    }

    public function sendEmailForPublishedChapter($data, $book, $emailsFollowingList)
    {

        Mail::later(1, 'emails._new_published_chapter', ['data' => $data], function ($message) use ($book, $emailsFollowingList) {
            $message->from(\Cache::get('contactusInfo')->email, 'E-boook.com');
            $message->subject('E-Boook.com | New Published Book | ' . $book->title);
            $message->priority('high');
            $message->to($emailsFollowingList, \Cache::get('contactusInfo')->email);
            $message->to('uusa35@gmail.com');
        });

    }
}