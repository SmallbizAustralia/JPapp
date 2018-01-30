<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\User as UserResource;
use App\Jobs\CancelSubscription;
use App\Mail\GettingStartedDone;
use App\Models\User;
use App\Notifications\UserInterested;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends ApiController
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('auth:api')->except(['sendResetLinkEmail', 'store', 'preRegister']);
    }

    public function show(Request $request)
    {
        return new UserResource($request->user());
    }

    public function update(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            abort(404);
        }

        $user->update($request->all());

        if ($request->input('getting_started_done')) {
            Mail::to('support@iamelitemenstrainer.com')->send(new GettingStartedDone($user));
        }

        return new UserResource($user);
    }

    public function uploadPhoto(Request $request)
    {
        \Log::info($request->all());
        $user = $request->user();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos');
            $user->update(['profile_photo' => $path]);
        }

        return new UserResource($user);
    }

    public function validateCard(Request $request)
    {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $data = \Stripe\Token::create([
                'card' => [
                    'number' => $request->input('number'),
                    'exp_month' => $request->input('month'),
                    'exp_year' => $request->input('year'),
                    'cvc' => $request->input('cvc'),
                ]
            ])->jsonSerialize();
            if ($request->input('subscribe')) {
                $request->user()->newSubscription('weekly', env('CF_WEEKLY_SUB_PLAN_ID'))->create($data['id']);
            } else {
                $request->user()->updateCard($data['id']);
            }

            $user = $request->user()->fresh();
            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'code' => 'validation_failed',
                'message' => $e->getMessage(),
            ], 404);
        }

    }

    public function renewSubscription(Request $request)
    {
        $user = $request->user();
        if (empty($user->stripe_id)) {
            return response()->json([
                'error' => true,
                'code' => 'subscription_needed',
                'message' => 'No subscription found!',
            ], 404);
        }

        try {
            $user->newSubscription('weekly', env('CF_WEEKLY_SUB_PLAN_ID'))->create();
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'subscription_needed',
                'message' => $e->getMessage(),
            ], 404);
        }


        return new UserResource($user);
    }

    public function cancelSubscription(Request $request)
    {
        $user = $request->user();
        try {
            $user->subscription('weekly')->cancel();
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'cancellation_failed',
                'message' => $e->getMessage(),
            ], 404);
        }

        $this->dispatch(new CancelSubscription($user));

        return new UserResource($user->refresh());

    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['success' => true])
            : response()->json(trans($response), 404);
    }

    public function store(Request $request)
    {
        $this->validateEmail($request);

        $user = User::whereEmail($request->email)->first();

        if (!$user) {
            // Just some default, will be overwritten from email sent
            $password = Str::random(10);
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($password),
            ]);

            event(new Registered($user));
        }

        return new UserResource($user);
    }

    /**
     * Just to notify Jay that we got an interested user (yet to subscribe)
     *
     * @param Request $request
     */
    public function preRegister(Request $request)
    {
        $user = User::whereEmail('client@jaypiggin.com.au')->first();
        $user->notify(new UserInterested($request->input('name'), $request->input('email')));

        return response()->json(['success' => true]);
    }
}
