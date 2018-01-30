<?php

namespace App\Models;

use App\Notifications\ResetPassword as ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $height
 * @property string $starting_weight
 * @property string $current_weight
 * @property string $goal_weight
 * @property string $age
 * @property string $timezone
 * @property string $profile_photo
 * @property int $type {1: default user, 5: admin }
 * @property bool $getting_started_done
 * @property string $stripe_id
 * @property string $card_brand
 * @property string $card_last_four
 * @property Carbon $trial_ends_at
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'height',
        'starting_weight',
        'current_weight',
        'goal_weight',
        'age',
        'timezone',
        'profile_photo',
        'type',
        'getting_started_done',
        'stripe_id',
        'card_last_four',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'getting_started_done' => 'boolean',
    ];

    protected $dates = [
        'trial_ends_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->latest();
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->type === 5;
    }

    public function validSubscription()
    {
        if ($this->subscribed('weekly')) {
            return $this->subscription('weekly');
        }

        // send a dummy lifetime sub
        if ($this->isAdmin() || $this->products()->lifetime()->count()) {
            return new Subscription([
                'name' => 'lifetime',
            ]);
        }

        return false;
    }

    public function hasLifetimeSubscription()
    {
        return $this->isAdmin() || $this->products()->lifetime()->count() > 0;
    }

    /**
     * Scope a query to only users of type 1.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMember($query)
    {
        return $query->whereType(1);
    }

    public function generateProgresses()
    {
        foreach ([1, 6, 10, 16, 22, 32, 40, 46, 52] as $week) {
            factory(Progress::class)->create(['week' => $week, 'user_id' => $this->id]);
        }
    }

    /**
     * Send the password reset notification.
     *
     * @see \Illuminate\Auth\Passwords\CanResetPassword
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
