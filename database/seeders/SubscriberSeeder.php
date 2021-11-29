<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('subscriptions')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'website_id' => 1,
            'hash' => Str::random(40)
        ]);
    }
}
