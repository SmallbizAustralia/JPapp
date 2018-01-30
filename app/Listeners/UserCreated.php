<?php

namespace App\Listeners;

use App\Notifications\UserSignup as UserSignupNotification;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class UserCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        $password = Str::random(10);
        $user->update([
            'password' => bcrypt($password),
        ]);

        $user->generateProgresses();

        $user->notify(new UserSignupNotification($password));

        if (App::environment('production')) {
            $client = new Client();
            $client->post('https://jaypiggin.clickfunnels.com/optin17703888', [
                'form_params' => [
                    'contact[name]' => $user->name,
                    'contact[email]' => $user->email,
                ]
            ]);
        }
    }
}
