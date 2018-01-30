<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        \DB::table('users')->truncate();
        \DB::table('contents')->truncate();
        \DB::table('progresses')->truncate();
        \DB::table('products')->truncate();
        \DB::table('subscriptions')->truncate();
        $this->call(UsersTableSeeder::class);
        $this->call(ContentsTableSeeder::class);

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }
}
