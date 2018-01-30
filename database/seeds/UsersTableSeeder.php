<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class)->create(['email' => 'client@jaypiggin.com.au', 'password'=> bcrypt('2eDhy2YbhLnpvIaV'), 'type' => 5, 'name' => 'Jay Piggin']);
        factory(App\Models\User::class)->create(['email' => 'jovani@test.com', 'name' => 'Jovani']);
        factory(App\Models\User::class)->create(['email' => 'matt@test.com', 'password' => bcrypt('access2017x'), 'name' => 'Matthew Withoos']);
        factory(App\Models\User::class, 20)->create();

        // Progress for weeks 1, 6, 10, 16, 22, 32, 40, 46, 52
        foreach (App\Models\User::all() as $user) {
            foreach ([1, 6, 10, 16, 22, 32, 40, 46, 52] as $week) {
                $user->progresses()->save(factory(App\Models\Progress::class)->create(['week' => $week]));
            }

            $user->subscriptions()->save(factory(App\Models\Subscription::class)->create());
            $user->products()->save(factory(App\Models\Product::class)->create());
        }
    }
}
