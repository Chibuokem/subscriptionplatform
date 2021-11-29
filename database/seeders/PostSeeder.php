<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert([
            'title' => Str::random(10),
            'description' => 'Lorem ipsum text '.Str::random(30),
            'website_id' => 1,
        ]);
    }
}
