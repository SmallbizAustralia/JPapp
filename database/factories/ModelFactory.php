<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'height' => rand(150, 200),
        'starting_weight' => rand(60, 150),
        'goal_weight' => rand(50, 200),
        'current_weight' => rand(60, 150)
    ];
});

$factory->define(App\Models\Content::class, function (Faker\Generator $faker) {
    $paragraphs = $faker->paragraphs($nb = 2);
    return [
        'content' => implode('', array_map(function($paragraph) { return "<p>".$paragraph."</p>"; }, $paragraphs)),
        'title' => $faker->text($maxNbChars = 25),
        'source' => 'https://player.vimeo.com/external/188926821.sd.mp4?s=095116a39a5448963cf0d57d83ca8e1810c3862e&profile_id=164',
        'source_type' => 'video',
        'preview' => 'http://via.placeholder.com/300x200',
        'published' => 0,
    ];
});

$factory->define(App\Models\Progress::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 0, // temporary default
    ];
});

$factory->define(App\Models\Subscription::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 0, // temporary default
        'name' => 'weekly',
        'stripe_id' => 'sub_' . \Illuminate\Support\Str::random(10),
        'stripe_plan' => 'weekly-plan',
        'quantity' => 1,
        'trial_ends_at' => \Carbon\Carbon::now()->addDays(7),
    ];
});


$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    static $products = [
        '1028436' => 'I AM ELITE – MENS TRAINER FREE 7 DAY TRIAL',
        '1028437' => 'THE COMPLETE STRENGTH AND TESTOSTERONE ENHANCEMENT GUIDE FOR MEN!',
        '1029265' => 'UNLIMITED LIFETIME ACCESS (SAVE 70%)'
    ];
    $product = array_rand($products);
    return [
        'user_id' => 0, // temporary default
        'click_funnels_product_id' => (int)$product,
        'name' => $products[$product],
        'amount' => 7,
        'ends_at' => \Carbon\Carbon::now()->addDays(7),
    ];
});