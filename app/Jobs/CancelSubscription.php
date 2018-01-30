<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CancelSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @param User $user
     * 
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->user->subscribed('weekly')) {
            $this->user->subscription('weekly')->cancel();
        }

        // Charge user with cancellation fee of 9usd if 48hrs or less to end date already
        $subscription = $this->user->subscription('weekly');
        if ($subscription && $subscription->ends_at->diffInHours(\Carbon\Carbon::now()) <= 48) {
            $this->user->invoiceFor('Cancellation Fee', env('CANCELLATION_FEE', 900));
            \Log::info('Cancellation Fee :: ' . $this->user->id);
        }

        /**
        notify client of cancelled subscription via email
         */
        $data = [
            'name' => $this->user->name,
            'email' => $this->user->email
        ];

        \Mail::send('emails.cancel', $data , function($message){
            $message->to('support@iamelitemenstrainer.com')
                ->subject("Cancelled subscription on I Am Elite Men's Trainer App");
        });
    }
}
