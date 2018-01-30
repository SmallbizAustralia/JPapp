<?php

namespace App\Models;

/**
 * Class Subscription
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $stripe_id
 * @property string $stripe_plan
 * @property int $quantity
 * @property \Carbon\Carbon $trial_ends_at
 * @property \Carbon\Carbon $ends_at
 * @property string $transaction_data Raw transaction data from external source such as Stripe
 */
class Subscription extends \Laravel\Cashier\Subscription
{
    protected $casts = [
        'transaction_data' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'stripe_id',
        'stripe_plan',
        'quantity',
        'trial_ends_at',
        'ends_at',
        'transaction_data',
    ];
}
