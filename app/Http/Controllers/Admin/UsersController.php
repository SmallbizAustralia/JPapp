<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\CancelSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::member()->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::with('products')->find($id);

        if ($request->isMethod('post')) {
            if ($request->input('submit-button') === 'Cancel Subscription') {
                dispatch(new CancelSubscription($user));
                return redirect()->route('admin.users.edit', $user)->with('result-message', 'Cancellation is being processed.');
            }
            $user->update($request->all());
            return redirect()->route('admin.users')->with('result-message', 'Changes saved.');
        }

        return view('admin.users.edit', compact('user'));
    }
}
