<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * A job to retrieve subscriptions directly to Stripe
 * given a subscription id (we received from clickfunnels).
 *
 * @package App\Jobs
 */
class RetrieveSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $subscriptionId;
    private $user;

    /**
     * Create a new job instance.
     *
     * @param int $userId The user id
     * @param string $subscriptionId The Stripe subscription id
     *
     * @return void
     */
    public function __construct($userId, $subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
        $this->user = User::find($userId);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $testmode_ignored = ['sub_BfbeSHLX0SypgY'];

        if(!in_array($this->subscriptionId, $testmode_ignored)) {
            $stripeData = \Stripe\Subscription::retrieve($this->subscriptionId)->jsonSerialize();
            $this->user->update([
                'stripe_id' => $stripeData['customer'],
                'trial_ends_at' => !empty($stripeData['trial_end']) ? \Carbon\Carbon::createFromTimestamp($stripeData['trial_end']) : null,
            ]);

            $subscription = Subscription::firstOrNew([
                'user_id' => $this->user->id,
                'stripe_id' => $stripeData['id'],
                'name' => 'weekly',
            ]);

            $subscription->stripe_plan = $stripeData['plan']['id'];
            $subscription->quantity = $stripeData['quantity'];
            $subscription->transaction_data = $stripeData;
            $subscription->trial_ends_at = !empty($stripeData['trial_end']) ? \Carbon\Carbon::createFromTimestamp($stripeData['trial_end']) : null;
            $subscription->save();

            // Update product expiry
            if (!empty($stripeData['trial_end']) && $product = Product::where('user_id', $this->user->id)->where('click_funnels_product_id', (int)env('CF_WEEKLY_SUB_PRODUCT_ID'))->first()) {
                $product->update([
                    'ends_at' => \Carbon\Carbon::createFromTimestamp($stripeData['trial_end'])
                ]);
            }
        }
    }
}
