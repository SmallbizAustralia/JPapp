<?php

namespace App\Http\Controllers;

use App\Events\ProductPurchased;
use App\Jobs\RetrieveSubscription;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    private function createUser($data = [])
    {
        $user = null;

        $validator = Validator::make($data, [
            'email' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            return User::whereEmail($data['email'])->first();
        }

        $password = Str::random(10); // some random password we would email to user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($password),
        ]);

        event(new Registered($user));

        return $user;
    }

    private function createProduct($user, $data = [])
    {
        $product = Product::firstOrCreate([
            'user_id' => $user->id,
            'name' => $data['name'],
            'click_funnels_product_id' => $data['id'],
        ]);

        if ($product->wasRecentlyCreated) {
            event(new ProductPurchased($product));
        }

        $product->update([
            'amount' => $data['amount']['fractional'],
            'raw_data' => $data,
        ]);

        return $product;
    }

    public function webhook(Request $request)
    {
        if ($request->hasHeader('x-clickfunnels-webhook-delivery-id') === false) {
            abort(403);
        }

        if ($data = $request->input('purchase')) {
            if ($user = $this->createUser($data['contact'])) {
                if (!empty($data['products'])) {
                    $all_products = "";
                    foreach ($data['products'] as $product) {
                        $this->createProduct($user, $product);
                        $all_products = $product['name'].", ".$all_products;
                    }
                    $data = [
                        'email' => $user->email,
                        'name' => $user->name,
                        'products' => $all_products,
                    ];
                    \Mail::send('emails.newpaiduser', $data, function($message) use ($data) {
                        $message->to('support@iamelitemenstrainer.com');
                        $message->subject('User paid for a new product');
                    });
                }
            }
        }

        if ($request->input('contact')) {
            $this->createUser($request->input('contact'));
        } elseif (($data = $request->input('purchase')) && !empty($data['subscription_id'])) {
            if ($user = $this->createUser($data['contact'])) {
                dispatch(new RetrieveSubscription($user->id, $data['subscription_id']));
            }
        }

        return response()->json(['success' => true]);
    }
}
