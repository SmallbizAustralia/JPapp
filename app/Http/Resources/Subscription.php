<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Subscription extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $status = 'active';

        if (!$request->user()->hasLifetimeSubscription()) {
            if ($request->user()->onTrial('weekly')) {
                $status = 'trial';
            }
            if ($request->user()->subscription('weekly')->onGracePeriod()) {
                $status = 'cancelled';
            }
        }

        return [
            'name' => $this->name,
            'plan' => $this->stripe_plan,
            'end' => $this->ends_at ? $this->ends_at->format('Y-m-d') : null,
            'days_left' => $this->ends_at ? ($this->ends_at->diffInDays(\Carbon\Carbon::now()) + 1) : null,
            'status' => $status
        ];
    }
}
