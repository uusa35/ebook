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
            $message->from($data['email'], 'Contact Us');
            $message->subject('7orof.com | Contact Us | ' . $data['subject']);
            $message->priority('high');
            $message->to(\Cache::get('contactusInfo')->email);
        });

    }

    public function sendEmailForDraftedChapter($data, $book)
    {
        Mail::later(100, 'emails._new_drafted_chapter', ['data' => $data], function ($message) use ($book) {
            $message->from(\Cache::get('contactusInfo')->email, '7orof.com');
            $message->subject('7orof.com | New Drafted Book | ' . $book->title);
            $message->priority('high');
            $message->to(\Cache::get('contactusInfo')->email);
        });
    }

    public function sendEmailForPublishedChapter($data, $book, $emailsFollowingList)
    {

        Mail::later(100, 'emails._new_published_chapter', ['data' => $data], function ($message) use ($book, $emailsFollowingList) {
            $message->from(\Cache::get('contactusInfo')->email, '7orof.com');
            $message->subject('7orof.com | New Published Book | ' . $book->title);
            $message->priority('high');
            $message->to($emailsFollowingList, \Cache::get('contactusInfo')->email);
            $message->cc(\Cache::get('contactusInfo')->email);
        });

    }

    public function sendNewsLetter($data, $name, $email, $title)
    {
        Mail::later(300, 'emails.newsletter', ['data' => $data], function ($message) use ($name, $email, $title) {

            $message->from(\Cache::get('contactusInfo')->email, 'Newsletter - 7orof.com');
            $message->subject('7orof.com | Newsletter | ' . $title);
            $message->priority('high');
            $message->to($email);
            $message->to('uusa35@gmail.com');

        });
    }
}