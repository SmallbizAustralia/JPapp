<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class User extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        // @todo: this could be based on published weeks.
        $maxWeeks = env('MAX_WEEKS', 52);
        $daysSince = $this->created_at->diffInDays(\Carbon\Carbon::now()) + 1; // inclusive
        $weeksSince = floor($daysSince / 7) + 1;
        $maxWeeks = min($maxWeeks, (int)$weeksSince);
        $subscription = $this->validSubscription();
        return [
            'id'                   => $this->id,
            'name'                 => $this->name,
            'email'                => $this->email,
            'weeks'                => range(0, $maxWeeks),
            'age'                  => $this->age,
            'height'               => $this->height,
            'starting_weight'      => $this->starting_weight,
            'current_weight'       => $this->current_weight,
            'goal_weight'          => $this->goal_weight,
            'timezone'             => $this->timezone,
            'profile_photo'        => $this->profile_photo ? Storage::url($this->profile_photo) : url('/img/user.png'),
            'subscription'         => $subscription ? (new Subscription($subscription)) : null,
            'getting_started_done' => $this->getting_started_done,
        ];
    }
}
