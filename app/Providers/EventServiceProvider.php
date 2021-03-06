<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\CreateChapter' => [
            'App\Listeners\CreatePdf',
            'App\Listeners\CalculateChapterPage'
        ],
        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            'SocialiteProviders\Google\GoogleExtendSocialite@handle',
            'SocialiteProviders\Twitter\TwitterExtendSocialite@handle'
        ],
        'App\Events\ChapterStatusChanged' => [
            'App\Listeners\SendEmailForChapterStatusChanged'
        ],
        'App\Events\SendRegisterationConfirmationEmail' => [
            'App\Listeners\SendRegisterationConfirmationEmailListener'
        ],

    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
